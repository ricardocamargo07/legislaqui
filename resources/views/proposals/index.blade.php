@extends('layouts.alerj')

@section('title', config('app.name'))

@section('content')
    <div class="cards-lista-ideias">
        @include('partials.error')


        <div class="row">

            <div class="col-md-6 text-left">
                {{--

                                <div class="pb-2 font-weight-bold">
                                    Contribua com uma democracia viva, participe do processo legislativo.
                                </div>
                --}}

                <h1>
                    Quer propor um projeto na Alerj?
                </h1>
                <div class="lead pb-3">
                    Sua boa ideia agora pode virar lei. Seja bem-vindo (a) à plataforma <span class="font-weight-bold">Legislaqui</span>. Por esta ferramenta você pode contribuir para a melhoria da sua cidade, do seu bairro e da sua família. Basta clicar no campo abaixo e sugerir a sua ideia. Vamos começar?

                </div>

                <div class="mt-2">
                    @if (!Auth::check())
                        <a class="btn-lg btn-primary mr-3" dusk="newProposalButton" href="{{ route('proposal.create') }}" onclick="if(!confirm('Para incluir nova ideia legislativa você deve estar logado')){return false;};">
                            @else
                                <a class="btn-lg btn-primary" dusk="newProposalButton" href="{{ route('proposal.create') }}">
                                    @endif
                                    <i class="fa fa-plus-circle"></i> Criar ideia legislativa
                                </a>
                        </a>


                        <a class="btn-lg btn-outline-primary mr-3" href="{{ route('about.howto') }}" >
                            <i class="far fa-question-circle"></i> Saiba como funciona
                        </a>

                </div>

                <div class="mt-4">
                    &sup1; Verifique se sua ideia já existe em forma de <a href="http://www3.alerj.rj.gov.br/lotus_notes/default.asp?id=55" target="_blank">lei</a> ou <a href="http://www3.alerj.rj.gov.br/lotus_notes/default.asp?id=144" target="_blank">projeto de lei</a>.
                </div>

{{--
                <div class="pb-3">
                    &sup2; <a href="">Acompanhe aqui</a> a tramitação dos projetos de lei oriundos de ideias legislativas do legislaqui
                </div>
--}}


            </div>
            <div class="col-md-6">

                <div class='embed-container'>
                    <iframe src='https://www.youtube.com/embed//Nh3WXmYXdyU' frameborder='0' allowfullscreen></iframe>
                </div>

                {{--<img src="imagens/legislaqui-website-mockup.png" class="img-fluid">--}}
            </div>
        </div>





        {{--
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h1><i class="fas fa-clipboard-list"></i> Ideias Legislativas</h1>
                        <div class="lead pb-3">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fringilla in arcu et gravida.
                            Curabitur finibus vulputate velit egestas ullamcorper. Suspendisse dignissim vitae urna in congue.
                            Etiam ac vulputate ante, sit amet suscipit elit.
                        </div>



                        <div class="lead pb-3">
                            Verifique se sua ideia já existe em forma de <a href="http://www3.alerj.rj.gov.br/lotus_notes/default.asp?id=55" target="_blank">lei</a> ou <a href="http://www3.alerj.rj.gov.br/lotus_notes/default.asp?id=144" target="_blank">projeto de lei</a>.
                        </div>
                    </div>
                </div>


                --}}

        <form id="filter-proposals" class="my-auto w-100 d-inline-block order-1" action="{{ route('home.post') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12 col-md-12">
                    <!-- search not in navbar collapse -->
                    <nav class="navbar navbar-expand navbar-light mt-3 mb-3">
                        <div class="d-flex flex-grow-1">
                            <div class="input-group">
                                <input type="text"  name="search" value="{{$search}}" class="form-control border" placeholder="Busque uma ideia ...">

                                {{--
                                                                <span class="input-group-append">
                                                                        <button class="btn btn-primary border border-left-0" type="submit" >
                                                                            <i class="fas fa-search"></i>
                                                                        </button>
                                                                </span>
                                --}}

                            </div>

                        </div>
                    </nav>
                </div>
            </div>

            <div class="row mb-5 controles">
                <div class="col-3">
                    {{ Form::select('state', $states, $state ,['data-width'=>'100%','data-style'=>'form-control', 'data-live-search'=>'true', 'title'=>'Situação']) }}
                </div>
               {{--  <div class="col-3">
                    {{ Form::select('subject', $subjects, $selected_subjects, ['name'=>'selected_subjects[]','multiple','data-width'=>'100%','data-style'=>'form-control', 'data-live-search'=>'true', 'title'=>'Assuntos','data-selected-text-format="count"']) }}
                </div> --}}

                <div class="col-3">
                    {{ Form::select('order_by', $orderBys, $order_by ,['data-width'=>'100%','data-style'=>'form-control', 'data-live-search'=>'true', 'title'=>'Ordenar por']) }}
                </div>
                <div class="col-1">
                    {{ Form::select('per_page', $pageSizes, $per_page ,['data-width'=>'100%','data-style'=>'form-control', 'data-live-search'=>'true', 'title'=>'Resultados por página']) }}
                </div>

                <div class="col-2">
                    <button class="btn btn-primary btn-block border border-left-0" type="submit" >
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                </div>


            </div>
        </form>
        <div class="row">
            @if ($proposals->count()>0)
                @foreach ($proposals as $proposal)

                    <div class="col-sm-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <a href="{{ route('proposal.show',array('id'=>$proposal->id)) }}" class="stretched-link">
                                    <h5 class="card-title"><i class="fas fa-list-alt"></i>
                                        {{$proposal->name}}
                                    </h5>
                                </a>

                                <p>
                                    @include('proposals.partials.badge')
                                </p>

                                <p class="card-text">
                                    {{$proposal->idea_exposition}}
                                </p>

                                @if (isset($is_not_responded) && Auth::user()->is_admin)
                                    <td><a href="{{ route('proposal.response', $proposal->id) }}" class="btn btn-danger">Responder Proposta</a></td>
                                @else
                            </div>

                            <div class="card-footer">
                                @if(config('app.likes_enabled'))
                                    <span class="curtidas">
                                <i class="fa fa-thumbs-{{$proposal->total_like_count < 0 ? 'down' : 'up'}}" aria-hidden="true"></i> {{$proposal->total_like_count }} Curtidas
                            </span>
                                @endIf

                                @if(config('app.likes_enabled'))
                                    <span class="apoios ml-3">
                                @endIf
                                    <i class="fa fa-star" aria-hidden="true"></i> {{$proposal->approvals_count}} Apoios
                                @if(config('app.likes_enabled'))
                                    </span>
                                @endIf
                            </div>

                        </div>
                    </div>

                    @endif
                @endforeach
            @else
                <h3>Não há propostas</h3>
            @endif
        </div>

        <div class="row">
            <div class="col-12 mt-3">
                {{ $proposals->appends(Request::except('page'))->links() }}
            </div>
        </div>

    </div>


@stop
