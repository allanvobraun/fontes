<template>
  <div class="mx-5">
    <b-form
      @submit.prevent="onSubmit"
      @reset.prevent="onReset"
      ref="form"
      autocomplete="off"
    >
      <div class="row">
        <b-form-group label="N/S Rework:" class="col-sm-6">
          <auto-complete-search
            index="1"
            ref="search-input"
            v-model="form.fonte.cod_interno"
            @update="onFilled($event)"
            @keyup.enter.native="focusNextElement($event)"
            @result-selected="getFonte"
            :search="searchLike"
            required
          ></auto-complete-search>
        </b-form-group>

        <b-form-group label="N/S Fabricante:" class="col-sm-6">
          <b-form-input
            index="2"
            v-model="form.fonte.cod_font"
            @keyup.enter.native="focusNextElement($event)"
            required
            :disabled="lock.fonte"
          ></b-form-input>
        </b-form-group>
      </div>

      <div class="row">
        <b-form-group label="Modelo:" class="col-sm-6">
          <b-form-input
            v-model="form.fonte.modelo"
            :disabled="lock.fonte"
            @keyup.enter.native="focusNextElement($event)"
            index="3"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Fabricante:" class="col-sm-6">
          <b-form-input
            v-model="form.fonte.fabricante"
            :disabled="lock.fonte"
            @keyup.enter.native="focusNextElement($event)"
            index="4"
          ></b-form-input>
        </b-form-group>
      </div>

      <div class="row">
        <b-form-group label="Descrição problema:" class="col-sm-6">
          <b-form-input
            v-model="form.reparo.desc_problema"
            :disabled="lock.reparo"
            @keyup.enter.native="focusNextElement($event)"
            index="5"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Peças utilizadas:" class="col-sm-6">
          <b-form-input
            event="peças"
            v-model="form.reparo.peças"
            :disabled="lock.reparo"
            @keyup.enter.native="focusNextElement($event)"
            index="6"
          ></b-form-input>
        </b-form-group>
      </div>

      <div class="row">
        <b-form-group class="col-sm-6" label="Valor:">
          <money
            v-model="form.reparo.valor"
            v-bind="money"
            :disabled="lock.reparo"
            class="form-control"
            maxlength="9"
            index="7"
          ></money>
        </b-form-group>

        <b-form-group class="col-sm-6" label="Status:">
          <b-form-select
            :options="statuses"
            v-model="form.reparo.status"
            :disabled="lock.reparo"
            required
          ></b-form-select>
        </b-form-group>
      </div>

      <b-button type="submit" variant="primary" @click="checkTarget($event)">Enviar</b-button>
      <b-button type="reset" variant="danger">Limpar</b-button>
    </b-form>
  </div>
</template>

<script>
import { Money } from "v-money";
import AutoCompleteSearch from "./AutoCompleteSearch";

export default {
  components: { Money, AutoCompleteSearch },
  data() {
    return {
      form: {
        // foi achada  a fonte no banco
        fonteEncontradaStatus: false,
        fonte: {
          cod_font: "",
          cod_interno: "",
          modelo: "",
          fabricante: ""
        },
        reparo: {
          desc_problema: "",
          peças: "",
          status: "",
          valor: 0
        }
      },
      statuses: [{ text: "Selecione", value: "" }, "OK", "NOK"],
      money: {
        decimal: ",",
        prefix: "R$ ",
        precision: 2,
        masked: false
      },
      lock: {
        fonte: true,
        reparo: true
      }
    };
  },
  methods: {
    getFonte(text) {
      const url = `/api/fontes/${text}`;
      axios
        .get(url)
        .then(response => {
          this.form.fonte = response.data.data;
          this.lock.fonte = true;
          this.form.fonteEncontradaStatus = true;
          this.notify("Fonte encontrada!", "", "info");
        })
        .catch(error => {
          this.cleanFonte();
        });
    },
    async searchLike(input) {
      if (input.length < 1) return [];
      const url = `/api/fontes/search?query=${input}&attribute=cod_interno`;
      const arr = await axios.get(url).then(response => {
        return response.data.data;
      });
      return arr;
    },
    checkTarget(e) {
      // checa se o click veio do mause ou se foi do browser (0 é do browser)
      if (e.detail == 0) e.preventDefault();
    },
    lockAll(lock) {
      this.lock.fonte = lock;
      this.lock.reparo = lock;
    },

    saveFonte() {
      return axios
        .post("/api/fontes", this.form.fonte)
        .catch(error => {
          this.tratarErro(error.response, "Erro ao gravar a fonte!");
        });
    },

    saveReparo() {
      const url = `/api/fontes/${this.form.fonte.cod_interno}/reparos`;
      return axios
        .post(url, this.form.reparo)
        .catch(error => {
          this.tratarErro(error.response, "Erro ao gravar o reparo!");
        });
    },

    tratarErro(error, tituloMensagem) {
      const errorText = this.$helpers.getErroString(error);
      this.notify(tituloMensagem, errorText, "danger");
      throw new Error(tituloMensagem);
    },

    async onSubmit() {
      let fonte_data;
      let reparo_data;

      //só tenta salvar a fonte se ja não foi auto preenchida
      if (this.form.fonteEncontradaStatus === false) {
        fonte_data = await this.saveFonte();
      }
      reparo_data = await this.saveReparo();
      this.notificarSave(fonte_data, reparo_data);
      this.onReset();
    },

    notificarSave(fonte_data, reparo_data) {
      const fonte_txt = fonte_data ? "Fonte salva com sucesso" : "";
      const reparo_txt = reparo_data ? "Reparo da fonte salva com sucesso" : "";
      const responte_txt = `${fonte_txt} ${reparo_txt}`;

      this.notify("Enviado com sucesso!", responte_txt, "success");
    },

    onReset() {
      this.form.fonte = _.mapValues(this.form.fonte, () => "");
      this.form.reparo = _.mapValues(this.form.reparo, () => "");
      // Trick to reset/clear native browser form valeventation state
      this.lockAll(true);
      this.form.fonteEncontradaStatus = false;
      const input = this.$refs["search-input"];
      input.$children[0].focus();
    },
    cleanFonte() {
      this.form.fonte = _.mapValues(this.form.fonte, (value, key) => {
        return key !== "cod_interno" ? "" : value;
      });
      this.form.fonteEncontradaStatus = false;
    },
    onFilled(text) {
      if (text !== "") {
        this.lockAll(false);
      } else {
        this.lockAll(true);
        this.cleanFonte();
      }
    },
    focusNextElement(event) {
      const idx = event.target.getAttribute("index");
      const next = (parseInt(idx) + 1).toString();
      const form = this.$refs.form;
      const inputs = Array.from(form.getElementsByTagName("input"));

      const next_input = inputs.find(
        input => input.getAttribute("index") === next
      );
      if (next_input !== undefined) next_input.focus();
    }
  }
};
</script>
