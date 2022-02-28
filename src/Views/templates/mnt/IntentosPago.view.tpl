<h1>{{modeDsc}}</h1>
<hr>
<section class="container-m">
  <form action="index.php?page=mnt.intentospagos.intentospagos&mode={{mode}}&id={{id}}" method="post" >
    <input type="hidden" name="crsxToken" value="{{crsxToken}}" />
    {{ifnot isInsert}}
    <fieldset class="row flex-center align-center">
        <label for="id" class="col-5">Código</label>
        <input class="col-7" id="id" name="id" value="{{id}}" placeholder="" type="text">
    </fieldset>
    {{endifnot isInsert}}
    <fieldset class="row flex-center align-center">
        <label class="col-5" for="fecha">Fecha</label>
        <input class="col-7" id="fecha" name="fecha" value="{{fecha}}" placeholder="" type="date" disabled="disabled">
    </fieldset>
    <fieldset class="row flex-center align-center">
        <label class="col-5" for="cliente">Nombre Cliente</label>
        <input class="col-7" id="cliente" name="cliente" value="{{cliente}}" placeholder="" type="text">
    </fieldset>
    <fieldset class="row flex-center align-center">
        <label class="col-5" for="monto">Monto</label>
        <input class="col-7" id="monto" name="monto" value="{{monto}}" placeholder="" type="number" step="0.01">
    </fieldset>
    <fieldset class="row flex-center align-center">
        <label class="col-5" for="fechaven">Fecha Vencimiento</label>
        <input class="col-7" id="fechaven" name="fechaven" value="{{fechaven}}" placeholder="" type="date" >
    </fieldset>
    <fieldset class="row flex-center align-center">
        <label class="col-5" for="estado">Estado</label>
        <select class="col-7" name="estado" id="estado">
          {{foreach estadoOptions}}
          <option value="{{value}}" {{selected}}>{{text}}</option>
          {{endfor estadoOptions}}
        </select>
    </fieldset class="row flex-center align-center">
    <fieldset class="row flex-end align-center">
        <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>
        &nbsp;<button type="button" id="btnCancelar" class="btn secondary">Cancelar</button>
        &nbsp;
    </fieldset>
  </form>
</section>
<script>
  /* */
  document.addEventListener("DOMContentLoaded", (e)=>{
    document.getElementById("btnCancelar").addEventListener('click', (e)=>{
      e.preventDefault();
      e.stopPropagation();
      location.assign("index.php?page=mnt.intentospagos.intentospagos");
    })
  });
</script>

<script>
document.getElementById("fecha").innerHTML = Date();
</script>

