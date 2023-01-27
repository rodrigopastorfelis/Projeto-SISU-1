
<style>

    .card{
        border-radius: 10px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px #ccc;
    }

    .reprovado{
        border-left: 10px solid #ff3300;
    }

    .reprovado i{
        color: #d63e17;
    }

    .aprovado{
        border-left: 10px solid #00cc00;
    }

    .aprovado i{
        color: #17b817;
    }

    .quadro_resultado{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .chances{
        text-align: right;
        margin: 0 0 0 0;
    }

    .notas_corte{
        text-align: left;
    }
</style>

{{-- <div class="col-10 mb-3">
    <div class="card reprovado">
        <div class="card-body">
            <h5 class="card-title mb-3">Universidade Federal de Minas Gerais</h5>
           <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2022: 817.22</h6> 

            <div class="quadro_resultado">
                <div class="notas_corte col-6">
                    <h6 class="card-subtitle mb-2">Notas de Corte</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">2022: 817.22</li>
                        <li class="list-group-item">2023: 817.22</li>
                    </ul>
                </div>

                <div class="col-6">
                    <p class="text-muted chances">
                        <i class="fas fa-long-arrow-alt-down"></i>
                        Chances Baixas de Aprovação
                        <i class="fas fa-frown"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@if(isset($simulacoes_positivas , $simulacoes_negativas,$simulacoes_neutras))
<div class="col-10 mb-3">
    <div class="card reprovado">
        <div class="card-body">
            <h5 class="card-title">Universidade Federal de Minas Gerais</h5>
            <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2022: 817.22</h6>
            <p class="text-muted chances">
                <i class="fas fa-long-arrow-alt-down"></i>
                Chances Baixas de Aprovação
                <i class="fas fa-frown"></i>
            </p>
        </div>
    </div>
</div>

<div class="col-10 mb-3">
    <div class="card aprovado">
        <div class="card-body">
            <h5 class="card-title">Universidade Federal de Minas Gerais</h5>
            <h6 class="card-subtitle mb-2 text-muted">Nota de Corte 2022: 817.22</h6>
            <p class="text-muted chances">
                <i class="fas fa-long-arrow-alt-up"></i>
                Chances Altas de Aprovação
                <i class="fas fa-laugh-beam"></i>
            </p>
        </div>
    </div>
</div>
@endif
{{-- fas fa-laugh-beam --}}