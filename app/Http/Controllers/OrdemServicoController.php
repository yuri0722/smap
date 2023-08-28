<?php namespace App\Http\Controllers;

use App\Http\Requests\AgricultorRequest;
use App\Http\Requests\OrdemServicoTipoRequest;
use App\Http\Requests\PesquisaRequest;
use App\Models\Agricultor\OsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdemServicoController extends Controller
{
    private $osRepository;

    public function __construct(OsRepository $osRepository)
    {
        $this->osRepository = $osRepository;
    }

    public function index()
    {
        $ordems = $this->osRepository->listarTodos();
        return view('os.index', compact('ordems'));
    }

    public function tipos()
    {
        $tipos = $this->osRepository->listarTipos();
        return view('os.tipos', compact('tipos'));
    }

    public function tipo_edit($id = null)
    {
        if ($id) {
            $tipo = $this->osRepository->findOrFailTipo($id);
            return view('os.tipo_edit', compact('tipo'));
        } else {
            return view('os.tipo_edit');
        }
    }

    public function tipo_update($id, OrdemServicoTipoRequest $request)
    {
        $tipo = $this->osRepository->findOrFailTipo($id);
        $tipo->fill($request->all());
        if ($this->osRepository->tipo_update($tipo)) {
            session::flash('success', 'Tipo de ordem de serviço editada com sucesso!');
            return redirect(route('agro.os_tipos'));
        }
    }
    public function subtipo_update($id, OrdemServicoTipoRequest $request)
    {
        $subtipo = $this->osRepository->findOrFailSubTipo($id);
        $subtipo->fill($request->all());
        if ($this->osRepository->subtipo_update($subtipo)) {
            session::flash('success', 'SubTipo de ordem de serviço editada com sucesso!');
            return redirect(route('agro.os_subtipo',$subtipo->ordem_servico_tipo_id));
        }
    }
    public function tipo_pesquisa(PesquisaRequest $request)
    {
        $busca = $request->busca;
        $tipos = $this->osRepository->tipo_pesquisa($busca);
        return view('os.tipos', compact('tipos', 'busca'));
    }

    public function tipo_store(OrdemServicoTipoRequest $request)
    {
        $dados = $request->all();
        if ($this->osRepository->tipo_store($dados)) {
            session::flash('success', 'Tipo de ordem de serviço cadastrada com sucesso!');
            return redirect(route('agro.os_tipos'));
        }
    }

    public function subtipo_store($id,OrdemServicoTipoRequest $request)
    {
        $dados = $request->all();
        if ($this->osRepository->subtipo_store($dados)) {
            session::flash('success', 'SubTipo de ordem de serviço cadastrada com sucesso!');
            return redirect(route('agro.os_subtipo',$id));
        }
    }

    public function subtipo_edit($id)
    {
        $subtipo = $this->osRepository->findOrFailSubTipo($id);
        return view('os.subtipo_edit', compact('subtipo'));
    }

    public function edit($id = null)
    {
        $tipos = $this->osRepository->listaSelectTipo();
        if ($id) {
            $ordem = $this->osRepository->findOrFail($id);
            return view('os.edit', compact('ordem'));
        } else {
            return view('os.edit', compact('tipos'));
        }
    }

    public function subtipo($id = null)
    {
        $tipo = $this->osRepository->findOrFailTipo($id);
        $subtipos = $this->osRepository->listarSubTipos($id);
        return view('os.subtipo', compact('tipo','subtipos'));
    }


}
