<?php

namespace App\Http\Controllers;

use App\Models\Bono;
use App\Models\Trabajador;
use Illuminate\Http\Request;

class BonoController extends Controller
{
    // 1. Procesa y calcula el bono con excedentes al CREAR
    public function store(Request $request)
    {
        $request->validate([
            'id_trabajador' => 'required|exists:trabajadores,id_trabajador',
            'operacion' => 'required|string|max:100',
            'objetivo_semanal' => 'required|integer|min:1',
            'lunes' => 'nullable|integer|min:0',
            'martes' => 'nullable|integer|min:0',
            'miercoles' => 'nullable|integer|min:0',
            'jueves' => 'nullable|integer|min:0',
            'viernes' => 'nullable|integer|min:0',
            'sabado' => 'nullable|integer|min:0',
            'monto_bono' => 'required|numeric|min:0',
        ]);

        $l = $request->lunes ?? 0;
        $m = $request->martes ?? 0;
        $mi = $request->miercoles ?? 0;
        $j = $request->jueves ?? 0;
        $v = $request->viernes ?? 0;
        $s = $request->sabado ?? 0;
        
        $totalPiezas = $l + $m + $mi + $j + $v + $s;

        // VALOR CONFIGURABLE: Cuánto se paga por cada pieza extra confeccionada (Ejemplo: $0.50 pesos)
        $pagoPorPiezaExtra = 0.50; 

        if ($totalPiezas >= $request->objetivo_semanal) {
            $cumplimiento = 'Cumple';
            
            // Calculamos cuántas piezas hizo de más
            $piezasExcedentes = $totalPiezas - $request->objetivo_semanal;
            
            // MATEMÁTICA: Bono Base + (Piezas de más * pago extra)
            $montoFinalBono = $request->monto_bono + ($piezasExcedentes * $pagoPorPiezaExtra);
        } else {
            $cumplimiento = 'No cumple';
            $montoFinalBono = 0.00;
        }

        Bono::create([
            'id_trabajador' => $request->id_trabajador,
            'operacion' => $request->operacion,
            'objetivo_semanal' => $request->objetivo_semanal,
            'lunes' => $l,
            'martes' => $m,
            'miercoles' => $mi,
            'jueves' => $j,
            'viernes' => $v,
            'sabado' => $s,
            'total_piezas' => $totalPiezas,
            'monto_bono' => $montoFinalBono,
            'cumplimiento' => $cumplimiento
        ]);

        return redirect('/bonos')->with('exito', '¡Producción registrada con incentivo por excedentes!');
    }

    // 2. Procesa y recalcula el bono con excedentes al EDITAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'operacion' => 'required|string|max:100',
            'objetivo_semanal' => 'required|integer|min:1',
            'lunes' => 'nullable|integer|min:0',
            'martes' => 'nullable|integer|min:0',
            'miercoles' => 'nullable|integer|min:0',
            'jueves' => 'nullable|integer|min:0',
            'viernes' => 'nullable|integer|min:0',
            'sabado' => 'nullable|integer|min:0',
            'monto_bono' => 'required|numeric|min:0',
        ]);

        $bono = Bono::findOrFail($id);

        $l = $request->lunes ?? 0;
        $m = $request->martes ?? 0;
        $mi = $request->miercoles ?? 0;
        $j = $request->jueves ?? 0;
        $v = $request->viernes ?? 0;
        $s = $request->sabado ?? 0;
        
        $totalPiezas = $l + $m + $mi + $j + $v + $s;
        
        // VALOR CONFIGURABLE: Mismo valor por pieza extra para el recalculo
        $pagoPorPiezaExtra = 0.50; 

        if ($totalPiezas >= $request->objetivo_semanal) {
            $cumplimiento = 'Cumple';
            $piezasExcedentes = $totalPiezas - $request->objetivo_semanal;
            $montoFinalBono = $request->monto_bono + ($piezasExcedentes * $pagoPorPiezaExtra);
        } else {
            $cumplimiento = 'No cumple';
            $montoFinalBono = 0.00;
        }

        $bono->update([
            'operacion' => $request->operacion,
            'objetivo_semanal' => $request->objetivo_semanal,
            'lunes' => $l,
            'martes' => $m,
            'miercoles' => $mi,
            'jueves' => $j,
            'viernes' => $v,
            'sabado' => $s,
            'total_piezas' => $totalPiezas,
            'monto_bono' => $montoFinalBono,
            'cumplimiento' => $cumplimiento
        ]);

        return redirect('/bonos')->with('exito', '¡Registro semanal actualizado y bono recalculado!');
    }

    public function edit($id)
    {
        $bono = Bono::with('trabajador')->find($id);
        $trabajadores = Trabajador::where('estatus', 'Activo')->get();
        
        if (!$bono) {
            return redirect('/bonos')->with('error', 'Registro no encontrado.');
        }
        return view('bonos.edit', compact('bono', 'trabajadores'));
    }

    public function destroy($id)
    {
        $bono = Bono::find($id);
        if ($bono) {
            $bono->delete();
            return redirect('/bonos')->with('exito', '¡Registro de la semana eliminado!');
        }
        return redirect('/bonos')->with('error', 'No se encontró el registro.');
    }
}
