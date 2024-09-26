<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\datapiket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class datapiketController extends Controller
{
    public function add(Request $request)
    {
        $nama_guru = explode(',', $request->input('nama_guru'));

        foreach ($nama_guru as $guru) {
            $guru = trim($guru);

            $adddatapiket = new datapiket();
            $adddatapiket->nama_guru = $guru;
            $adddatapiket->hari_piket = $request->input('hari_piket');
            $adddatapiket->save();
        }

        return redirect()->route('datapiket.index')->with('success', 'datapiket added successfully!');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $alldatapiket = datapiket::all();

        $query = datapiket::select('hari_piket', DB::raw('GROUP_CONCAT(nama_guru SEPARATOR ", ") as nama_guru'))
            ->groupBy('hari_piket');

        $indexdatapiket = $query->paginate(10);

        $totaldatapiket = datapiket::count();

        $editModalId = session('edit_modal_id');
        $editdatapiket = $editModalId ? datapiket::where('hari_piket', $editModalId)
            ->select('hari_piket', DB::raw('GROUP_CONCAT(nama_guru SEPARATOR ", ") as nama_guru'))
            ->groupBy('hari_piket')
            ->first() : null;

        return view('admin.guruPiket.datapiket', compact('indexdatapiket', 'editdatapiket', 'totaldatapiket', 'alldatapiket'));
    }

    public function hapus($hari_piket)
    {
        datapiket::where('hari_piket', $hari_piket)->delete();

        return redirect()->route('datapiket.index')->with('success', 'Data piket deleted successfully!');
    }

    public function edit($hari_piket)
    {
        $editdatapiket = datapiket::where('hari_piket', $hari_piket)
            ->select('hari_piket', DB::raw('GROUP_CONCAT(nama_guru SEPARATOR ", ") as nama_guru'))
            ->groupBy('hari_piket')
            ->first();

        if ($editdatapiket) {
            session()->flash('edit_modal_id', $editdatapiket->hari_piket);
        }

        return redirect()->route('datapiket.index');
    }

    public function update(Request $request, $hari_piket)
    {
        $validator = Validator::make($request->all(), [
            'nama_guru' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nama_gurus = explode(',', $request->input('nama_guru'));

        datapiket::where('hari_piket', $hari_piket)->delete();

        foreach ($nama_gurus as $nama_guru) {
            datapiket::create([
                'nama_guru' => trim($nama_guru),
                'hari_piket' => $hari_piket,
            ]);
        }

        return redirect()->route('datapiket.index')->with('success', 'Data piket updated successfully!');
    }
}
