
<style>
    @include('layouts.css.cards');
</style>
{{-- 
<div class="col-10 mb-3">
    <div class="card aprovado">

        <div class="card-body">
            <h5 class="card-title mb-3">{{$simulacao_positiva->sigla}} - {{$simulacao_positiva->nome}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2022: {{$simulacao_positiva->getsisu_anterior()}}</h6> 
            <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2023: {{$simulacao_positiva->nota}}</h6>

            <div class="quadro_resultado">
                <div class="col-12">
                    <p class="text-muted chances">
                        <i class="fas fa-long-arrow-alt-up"></i>
                        Nota final acima da nota de corte.
                        <i class="fas fa-laugh-beam"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@if(isset($faculdades_demais))
@foreach ($faculdades_demais as $faculdade) 
    <div class="col-10 mb-3">

        
        <div class="pagination">
            <a data-bs-toggle="collapse" href="#collapsecard{{$faculdade->id}}" role="button" aria-expanded="false" aria-controls="collapsecard{{$faculdade->id}} collapsecard2{{$faculdade->id}}">
                <i class="fas fa-circle fa-2xs"></i>
            </a>

            <a data-bs-toggle="collapse" href="#collapsecard2{{$faculdade->id}}" role="button" aria-expanded="false" aria-controls="collapsecard2{{$faculdade->id}} collapsecard{{$faculdade->id}}">
                <i class="fa-regular fa-circle fa-2xs"></i>
            </a>
        </div>

        <div class="collapse show" id="collapsecard{{$faculdade->id}}">
            <div class="card 
                @if(!$faculdade->getCalculoAnterior($user->id, $estado))reprovado @else aprovado @endif">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{$faculdade->estado}} - {{$faculdade->nome}} {{$faculdade->endereco}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2022: {{$faculdade->getsisu_anterior()}} *</h6> 
                    {{-- <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2023: {{$faculdade->getsisu_atual()}}</h6> --}}

                    <div class="quadro_resultado">
                        <div class="col-12">
                            <p class="text-muted chances">
                                @if(!$faculdade->getCalculoAnterior($user->id, $estado))
                                <i class="fas fa-long-arrow-alt-down"></i>
                                Nota final abaixo da nota de corte.
                                <i class="fas fa-frown"></i>
                                @else
                                <i class="fas fa-long-arrow-alt-up"></i>
                                Nota final acima da nota de corte.
                                <i class="fas fa-laugh-beam"></i>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="collapse" id="collapsecard2{{$faculdade->id}}">
            <div class="card 
                @if(!$faculdade->getCalculoAtual($user->id, $estado))reprovado @else aprovado @endif">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{$faculdade->estado}} - {{$faculdade->nome}} {{$faculdade->endereco}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2023: {{$faculdade->getsisu_atual()}} *</h6> 
                    {{-- <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2023: {{$faculdade->getsisu_atual()}}</h6> --}}

                    <div class="quadro_resultado">
                        <div class="col-12">
                            <p class="text-muted chances">
                                @if(!$faculdade->getCalculoAtual($user->id, $estado))
                                <i class="fas fa-long-arrow-alt-down"></i>
                                Nota final abaixo da nota de corte.
                                <i class="fas fa-frown"></i>
                                @else
                                <i class="fas fa-long-arrow-alt-up"></i>
                                Nota final acima da nota de corte.
                                <i class="fas fa-laugh-beam"></i>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- <div class="card-footer">
{{$faculdades_demais->links()}}
</div> --}}
@endif

<script>
</script>
