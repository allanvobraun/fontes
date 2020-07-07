<template>
  <div class="mx-5">
    <b-form @submit.prevent="onSubmit" @reset="onReset" v-if="show" ref="form" autocomplete="off">
      <div class="row">
        <b-form-group label="Código da fonte:" class="col-sm-6">
          <auto-complete-search
            v-model="form.fonte.cod_font"
            index="1"
            @update="onFilled($event)"
            @keyup.enter.native="focusNextElement($event)"
            @result-selected="getFonte"
            required
            :search="searchLike"
          ></auto-complete-search>
        </b-form-group>

        <b-form-group label="Código interno:" class="col-sm-6">
          <b-form-input
            index="2"
            v-model="form.fonte.cod_interno"
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

      <b-button type="submit" variant="primary" @click="checkTarget($event)">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
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
        fonteStatus: false,
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
      show: true,
      lock: {
        fonte: true,
        reparo: true
      }
    };
  },
  methods: {
    notify(title, body, type) {
      this.$notify({
        group: "alert",
        title: title,
        text: body,
        type: type
      });
    },
    getFonte(text) {
      const url = `/api/fontes/${text}`;
      axios
        .get(url)
        .then(response => {
          this.form.fonte = response.data.data;
          this.lock.fonte = true;
          this.form.fonteStatus = true;
          this.notify("Fonte encontrada", "", "info");
        })
        .catch(error => {
          this.cleanFonte();
          console.log("erroo");
        });
    },
    async searchLike(input) {
      if (input.length < 1) return [];
      const url = `/api/fontes/search?query=${input}&attribute=cod_font`;
      const arr = await axios
        .get(url)
        .then(response => {
          return response.data.data;
        });
      return arr;
    },
    checkTarget(e) {
      const target = e.explicitOriginalTarget;
      try {
        if (target.tagName === "INPUT") e.preventDefault();
      } catch (error) {
        console.log(error);
      }
    },
    lockAll(lock) {
      this.lock.fonte = lock;
      this.lock.reparo = lock;
    },
    onSubmit(evt) {
      let fonte_txt = "";
      let reparo_txt = "";
      if (!this.form.fonteStatus) {
        axios
          .post("/api/fontes", this.form.fonte)
          .then(response => console.log(response.data))
          .catch(error => {
            console.log(error.response);
          });
        fonte_txt = "Fonte salva com sucesso!";
      }

      const url = `/api/fontes/${this.form.fonte.cod_font}/reparos`;
      axios
        .post(url, this.form.reparo)
        .then(response => console.log(response.data))
        .catch(error => {
          console.log(error.response);
        });
      reparo_txt = "Reparo salvo com sucesso!";
      this.notify("Enviado com sucesoo!", `${fonte_txt} ${reparo_txt}`, "success");
    },
    onReset(evt) {
      evt.preventDefault();
      this.form.fonte = _.mapValues(this.form.fonte, () => "");
      this.form.reparo = _.mapValues(this.form.reparo, () => "");
      // Trick to reset/clear native browser form valeventation state
      this.show = false;
      this.lockAll(true);
      this.form.fonteStatus = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
    cleanFonte() {
      this.form.fonte = _.mapValues(this.form.fonte, (value, key) => {
        return key !== "cod_font" ? "" : value;
      });
      this.form.fonteStatus = false;
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