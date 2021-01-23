<template>
  <div class="container">
    <div id="agregar">
      <div class="card-header">
        <div class="card-title text-center">
          <h3>Crear peliculas</h3>
        </div>
      </div>
      <br /><br />
      <form @submit.prevent="crearPelicula()" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="imagen" class="form-label">*Imagen/Caratula:</label>
          <input
            id="input-id"
            type="file"
            class="fileinput"
            data-preview-file-type="text"
            data-browse-on-zone-click="true"
            @change="fileChange"
            required
          />
        </div>
        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="*titulo: "
            v-model="form_create.titulo"
          />
        </div>

        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="*Descripcion: "
            v-model="form_create.descripcion"
          />
        </div>
        <div class="mb-3">
          <label for="imagen" class="form-label">*Duracion:</label>
          <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="*Descripcion: "
            v-model="form_create.duracion"
          />
        </div>

        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="*Trailer youtube: "
            v-model="form_create.youtube"
          />
        </div>
        <div class="mb-3">
          <input
            type="date"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="*Fecha de estreno: "
            v-model="form_create.fecha_estreno"
          />
        </div>

        <div class="row form-group">
          <div class="col-md-12 col-lg-12 col-sm-12 text-center">
            <button type="submit" class="btn btn-success">
              <i class="fas fa-save"></i> Guardar
            </button>
            <button
              type="reset"
              id="btCan"
              class="btn btn-danger"
              v-on:click="clear()"
            >
              <i class="fas fa-window-close"></i> Cancelar
            </button>
          </div>
        </div>
      </form>
    </div>

    <br /><br /><br /><br />
    <div class="row form-group">
      <div class="col-md-12 col-lg-12 col-sm-12 text-center">
        <div class="card-header">
          <div class="card-title text-center">
            <h3>Listas</h3>
          </div>
        </div>
        <br />
        <b-button
          variant="info"
          size="sm"
          title="Listar por categoria"
          id="lista_calificarf"
          >CALIFICACIONES</b-button
        >
        <b-button
          variant="info"
          size="sm"
          title="Listar por categoria"
          id="categorias_list"
          >CATEGORIAS</b-button
        >
        <b-button variant="info" size="sm" id="lista_peliculas_boton"
          >PELICULAS</b-button
        >
        <b-button variant="info" size="sm" id="Add_pelicula"
          >AGREGAR PELICULA</b-button
        >
      </div>
    </div>
    <div class="container" id="lista_pelicular">
      <div id="" class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 text-center">
          <b-card no-body class="mb-1">
            <div class="card-header">
              <div class="card-title text-center">
                <h3>Lista peliculas</h3>
              </div>
            </div>
            <b-card-body>
              <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <vue-bootstrap4-table
                    :rows="rows_peliculas"
                    :columns="columns_peliculas"
                    :config="config"
                    :classes="classes"
                  >
                    <template slot="options" slot-scope="props">
                      <b-button
                        v-b-modal.calificar
                        variant="primary"
                        size="sm"
                        v-on:click="getCalificar(props.cell_value)"
                        title=""
                        id=""
                        >Calificar</b-button
                      >
                      <br />
                      <b-button
                        v-b-modal.agregar
                        variant="danger"
                        size="sm"
                        v-on:click="getAgregar(props.cell_value)"
                        title="Agregar Categoria"
                        id=""
                        >Agregar Categoria</b-button
                      >
                      <b-button
                        v-b-modal.ver_foto
                        variant="primary"
                        size="sm"
                        v-on:click="ver_image(props.cell_value)"
                        title=""
                        id=""
                        >Ver imagen</b-button
                      >
                    </template>
                    <template slot="empty-results" class="text-center">
                      <div class="text-center">
                        <!-- <b-spinner label="Spinning" v-if="this.loader == 'false'"></b-spinner>-->
                        <p>No se encontraron elementos para mostrar</p>
                      </div>
                    </template>
                  </vue-bootstrap4-table>
                </div>
              </div>
            </b-card-body>
          </b-card>
        </div>
      </div>
    </div>
    <br /><br />
    <div>
      <b-modal id="calificar" modal-cancel size="lg" title="Calificar pelicula">
        <div class="row">
          <div class="col-md-9 col-lg-9 col-sm-9" style="margin-left: 95px">
            <div class="card">
              <div class="card-body">
                <div class="col">
                  <div class="col">
                    <label
                      ><b>{{ "Pelicula: " + pelicula }}</b></label
                    >
                    <b-form-radio-group
                      v-model="form_calificacion.selected_calificacion"
                      :options="options"
                      class="mb-3"
                      value-field="item"
                      text-field="name"
                    ></b-form-radio-group>
                    <b-button size="lg" variant="primary" @click="Calificar()"
                      >Guardar
                    </b-button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <template v-slot:modal-footer="{ ok }">
          <b-button size="sm" variant="success" @click="ok()">
            Cerrar
          </b-button>
        </template>
      </b-modal>
    </div>
    <div>
      <b-modal id="agregar" modal-cancel size="lg" title="Calificar pelicula">
        <div class="row">
          <div class="col-md-9 col-lg-9 col-sm-9" style="margin-left: 95px">
            <div class="card">
              <div class="card-body">
                <div class="col">
                  <div class="col">
                    <label
                      ><b>{{ "Pelicula: " + pelicula }}</b></label
                    >
                    <b-form-group label="Categorias:*">
                      <multiselect
                        v-model="form_agregar.categorias"
                        deselect-label="Can't remove this value"
                        track-by="name"
                        label="name"
                        multiple
                        placeholder="Seleciones las categorias"
                        :show-labels="false"
                        :options="categorias_ddbb"
                        :searchable="true"
                        :allow-empty="false"
                        required
                      >
                        <template slot="singleLabel" slot-scope="{ option }"
                          ><strong>{{ option.name }}</strong></template
                        >
                      </multiselect>
                    </b-form-group>
                    <b-button
                      size="lg"
                      variant="primary"
                      @click="aregar_categoria()"
                      >Guardar
                    </b-button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <template v-slot:modal-footer="{ ok }">
          <b-button size="sm" variant="success" @click="ok()">
            Cerrar
          </b-button>
        </template>
      </b-modal>
    </div>
    <br /><br />
    <div class="container" id="lista_calificaciones">
      <div id="" class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
          <b-card no-body class="mb-1">
            <div class="card-header">
              <div class="card-title text-center">
                <h3>Lista calificación de peliculas</h3>
              </div>
            </div>
            <b-card-body>
              <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <vue-bootstrap4-table
                    :rows="rows_calificacion"
                    :columns="columns_calificacion"
                    :config="config"
                    :classes="classes"
                  >
                    <template slot="options" slot-scope="props">
                      <b-button
                        v-b-modal.calificar
                        variant="primary"
                        size="sm"
                        v-on:click="getCalificar(props.cell_value)"
                        title="Calificar"
                        id="calificar"
                        >Calificar</b-button
                      >
                    </template>
                    <template slot="empty-results" class="text-center">
                      <div class="text-center">
                        <!-- <b-spinner label="Spinning" v-if="this.loader == 'false'"></b-spinner>-->
                        <p>No se encontraron elementos para mostrar</p>
                      </div>
                    </template>
                  </vue-bootstrap4-table>
                </div>
              </div>
            </b-card-body>
          </b-card>
        </div>
      </div>
    </div>
    <div class="container" id="lista_categorias_por_pelicula">
      <div id="" class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
          <b-card no-body class="mb-1">
            <div class="card-header">
              <div class="card-title text-center">
                <h3>Lista de peliculas por categoria</h3>
              </div>
            </div>
            <b-card-body>
              <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <vue-bootstrap4-table
                    :rows="rows_lista_categoria"
                    :columns="columns_lista_categoria"
                    :config="config"
                    :classes="classes"
                  >
                    <template slot="empty-results" class="text-center">
                      <div class="text-center">
                        <!-- <b-spinner label="Spinning" v-if="this.loader == 'false'"></b-spinner>-->
                        <p>No se encontraron elementos para mostrar</p>
                      </div>
                    </template>
                  </vue-bootstrap4-table>
                </div>
              </div>
            </b-card-body>
          </b-card>
        </div>
      </div>
    </div>
       <div>
      <b-modal id="ver_foto" modal-cancel size="lg" title="Ver imagen pelicula">
        <div class="row">
          <div class="col-md-9 col-lg-9 col-sm-9" style="margin-left: 95px">
            <div class="card">
              <div class="card-body">
                <div class="col">
                  <div class="col">
                    <label
                      ><b>{{ "Pelicula: " + pelicula }}</b></label
                    >
                    <br>
                    <div class="image">
                                    <img :src="'images/clients/'+editImageLogo"
                                         class="rounded mx-auto d-block" style="max-width:100%;width:auto;height:auto;">
                                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <template v-slot:modal-footer="{ ok }">
          <b-button size="sm" variant="success" @click="ok()">
            Cerrar
          </b-button>
        </template>
      </b-modal>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
// import {Pie} from 'vue-chartjs';
//import Multiselect from "vue-multiselect";
import Multiselect from "vue-multiselect";
import VueBootstrap4Table from "vue-bootstrap4-table";
import Swal from "sweetalert2";
export default {
  created: function () {
    $(document).ready(function () {
      $("#lista_categorias_por_pelicula").hide();
      $("#lista_calificaciones").hide();
      $("#lista_pelicular").hide();
      $("#editar_indicador").hide();
      $("#Add_pelicula").hide();

      $("#lista_calificarf").click(function () {
        $("#Add_pelicula").show();
        $("#lista_calificaciones").show();
        $("#agregar").hide();
      });
      $("#lista_peliculas_boton").click(function () {
        $("#Add_pelicula").show();
        $("#lista_pelicular").show();
        $("#agregar").hide();
      });
      $("#Add_pelicula").click(function () {
        $("#Add_pelicula").hide();
        $("#lista_pelicular").hide();
        $("#agregar").show();
        $("#lista_calificaciones").hide();
        $("#lista_categorias_por_pelicula").hide();
      });
      $("#categorias_list").click(function () {
        $("#Add_pelicula").show();
        $("#lista_pelicular").hide();
        $("#agregar").hide();
        $("#lista_calificaciones").hide();
        $("#lista_categorias_por_pelicula").show();
      });
    });
  },
  mounted: function () {
    this.getCategorias();
    this.getPeliculas();
    this.getCalificaciones();
    this.getListaCategorias();
  },
  data: function () {
    return {
      form_calificacion: {
        idPelicula: "",
        selected_calificacion: "",
      },
      form_agregar: {
        idPelicula: "",
        categorias: [],
      },
      editImageLogo:"",
      categorias_ddbb: [],
      pelicula: "",
      options: [
        { item: "1", name: "1" },
        { item: "2", name: "2" },
        { item: "3", name: "3" },
        { item: "4", name: "4" },
        { item: "5", name: "5" },
      ],
      form_create: {
        imagen: "",
        titulo: "",
        descripcion: "",
        duracion: "",
        youtube: "",
        fecha_estreno: "",
      },
      rows_peliculas: [],
      columns_peliculas: [
        {
          label: "#",
          name: "id",
          sort: true,
        },
        {
          label: "Nombre Pelicula",
          name: "nombre",
        },
        {
          label: "Descripcion",
          name: "descripcion",
        },
        {
          label: "Duracion",
          name: "duracion",
        },
        {
          label: "Trailer",
          name: "trailer",
        },
        {
          label: "Estreno",
          name: "estreno",
        },
        {
          label: "Opciones",
          name: "options",
        },
      ],
      rows_lista_categoria: [],
      columns_lista_categoria: [
        {
          label: "#",
          name: "id",
          sort: true,
        },
        {
          label: "Nombre Pelicula",
          name: "nombre",
        },
        {
          label: "Categoria",
          name: "categoria",
        },
      ],
      rows_calificacion: [],
      columns_calificacion: [
        {
          label: "#",
          name: "id",
          sort: true,
        },
        {
          label: "Nombre Pelicula",
          name: "nombre",
        },
        {
          label: "Calificacion",
          name: "calificacion",
        },
      ],
      config: {
        show_refresh_button: false,
        show_reset_button: false,
        per_page: 10,
        card_mode: false,
        global_search: {
          placeholder: "Busqueda",
          visibility: true,
          case_sensitive: false,
          showClearButton: false,
          searchOnPressEnter: false,
        },
      },
      classes: {
        table: {
          "table table-striped table-striped-bg-default mt-3": true,
        },
      },
      configFileinput: {
        theme: "fas",
        showUpload: false,
        previewFileType: "any",
        showPreview: true,
        language: "es",
        maxFileCount: 1,
        allowedFileExtensions: ["jpg", "png"],
        overwriteInitial: false,
        dropZoneTitle: "Haga clic para seleccionar archivos...",
        dropZoneClickTitle: "",
        // maxImageWidth: 285,
        // maxImageHeight: 285,
      },
    };
  },
  methods: {
    fileChange: function (e) {
      this.form_create.imagen = e.target.files[0];
    },
    crearPelicula: function () {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();

      formData.append("imagen", this.form_create.imagen);
      formData.append("titulo", this.form_create.titulo);
      formData.append("descripcion", this.form_create.descripcion);
      formData.append("duracion", this.form_create.duracion);
      formData.append("youtube", this.form_create.youtube);
      formData.append("fecha_estreno", this.form_create.fecha_estreno);
      axios
        .post("/crearPelicula", formData, config)
        .then((response) => {
          this.loader = true;
          Swal.fire("", "Pelicula registrada!", "success");
          console.log(response);
          this.getPeliculas();
        })
        .catch((error) => {
          Swal.fire("Oops...", "Pelicula No resgistrada!", "error");
          this.loader = true;
        });
    },
    //Listar categorias select
    getCategorias: function () {
      axios
        .get("/getCategorias")
        .then((response) => {
          this.categorias_ddbb = [];
          console.log(response.data);
          let cat = response.data;
          for (let i in response.data) {
            this.categorias_ddbb.push({
              id: response.data[i].id_categoria,
              name: response.data[i].cat_nombre,
            });
          }
        })
        .catch((e) => {
          console.log(e.response);
        });
    },
    //Lista peliculas
    getPeliculas: function () {
      this.loader = "false";
      axios
        .get("/getPeliculas")
        .then((response) => {
          let checkboxes_aux = [];
          let report_aux = [];
          let count = 1;
          for (let i in response.data) {
            report_aux.push({
              id: count++,
              nombre: response.data[i].pel_titulo,
              descripcion: response.data[i].pel_descripcion,
              duracion: response.data[i].pel_duracion,
              trailer: response.data[i].pel_trailer,
              estreno: response.data[i].pel_fecha_estreno,
              options: response.data[i].id_pelicula,
            });
          }

          this.rows_peliculas = report_aux;
          this.checkboxes = checkboxes_aux;
          this.loader = "true";

          //this.options_crud = 2;
          //console.log(response.data);
        })
        .catch((e) => {
          alert("mal");
          console.log(e.response);
          console.log(e.data);
        });
    },

    getCalificar: function (id) {
      this.form_calificacion.idPelicula = id;
      axios
        .get("/getCalificar/" + id)
        .then((response) => {
          this.pelicula = response.data[0].pel_titulo;
        })
        .catch((error) => {
          console.log(error);
          // console.log("aaa");
        });
    },
    Calificar: function () {
      axios
        .post("/calificar", this.form_calificacion)
        .then((response) => {
          Swal.fire("", "Calificacion registrada!", "success");
          this.getCalificaciones();
        })
        .catch((error) => {
          Swal.fire("Oops...", "Calificacion No resgistrada!", "error");
        });
    },
    getAgregar: function (id) {
      this.form_agregar.idPelicula = id;
      axios
        .get("/getAgregar/" + id)
        .then((response) => {
          this.pelicula = response.data[0].pel_titulo;
          this.getPeliculas();
        })
        .catch((error) => {
          console.log(error);
          // console.log("aaa");
        });
    },
    //agregar categoria
    aregar_categoria: function () {
      axios
        .post("/aregar_categoria", this.form_agregar)
        .then((response) => {
          Swal.fire("", "Registrado!", "success");
        })
        .catch((error) => {
          Swal.fire("Oops...", "No resgistrada!", "error");
        });
    },
    //Lista de calificacion de las peliculas
    getCalificaciones: function () {
      this.loader = "false";
      axios
        .get("/getCalificaciones")
        .then((response) => {
          let checkboxes_aux = [];
          let report_aux = [];
          let count = 1;
          for (let i in response.data) {
            report_aux.push({
              id: count++,
              nombre: response.data[i].pel_titulo,
              calificacion: response.data[i].cal_pelicula,
            });
          }

          this.rows_calificacion = report_aux;
          this.checkboxes = checkboxes_aux;
          this.loader = "true";

          //this.options_crud = 2;
          //console.log(response.data);
        })
        .catch((e) => {
          alert("mal");
          console.log(e.response);
          console.log(e.data);
        });
    },

    ver_image: function (id) {
      this.editImageLogo = "";
      this.client_id = id;
      axios
        .get("/getPeliculas/" + id)
        .then((response) => {
          this.editImageLogo = response.data.logo;
        })
        .catch((error) => {
          // console.log('error');
          // console.log(error);
        });
    },
    //Lista de calificacion de las peliculas
    getListaCategorias: function () {
      this.loader = "false";
      axios
        .get("/getListaCategorias")
        .then((response) => {
          let checkboxes_aux = [];
          let report_aux = [];
          let count = 1;
          for (let i in response.data) {
            report_aux.push({
              id: count++,
              nombre: response.data[i].pel_titulo,
              categoria: response.data[i].cat_nombre,
            });
          }

          this.rows_lista_categoria = report_aux;
          this.checkboxes = checkboxes_aux;
          this.loader = "true";

          //this.options_crud = 2;
          //console.log(response.data);
        })
        .catch((e) => {
          alert("mal");
          console.log(e.response);
          console.log(e.data);
        });
    },
    messageAlert: function (state, title, msj) {
      this.$swal({
        type: state,
        title: title,
        text: msj,
      });
    },
  },
  components: {
    VueBootstrap4Table,
    Multiselect,
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
