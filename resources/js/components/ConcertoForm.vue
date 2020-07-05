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
            :disabled="lock"
          ></b-form-input>
        </b-form-group>
      </div>

      <div class="row">
        <b-form-group label="Modelo:" class="col-sm-6">
          <b-form-input
            v-model="form.fonte.modelo"
            :disabled="lock"
            @keyup.enter.native="focusNextElement($event)"
            index="3"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Fabricante:" class="col-sm-6">
          <b-form-input
            v-model="form.fonte.fabricante"
            :disabled="lock"
            @keyup.enter.native="focusNextElement($event)"
            index="4"
          ></b-form-input>
        </b-form-group>
      </div>

      <div class="row">
        <b-form-group label="Descrição problema:" class="col-sm-6">
          <b-form-input
            v-model="form.reparo.problema"
            :disabled="lock"
            @keyup.enter.native="focusNextElement($event)"
            index="5"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Peças utilizadas:" class="col-sm-6">
          <b-form-input
            event="peças"
            v-model="form.reparo.peças"
            :disabled="lock"
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
            :disabled="lock"
            class="form-control"
            maxlength="9"
            index="7"
          ></money>
        </b-form-group>

        <b-form-group class="col-sm-6" label="Status:">
          <b-form-select :options="statuses" v-model="form.reparo.status" :disabled="lock" required></b-form-select>
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
        fonte: {
          cod_font: "",
          cod_interno: "",
          modelo: "",
          fabricante: ""
        },
        reparo: {
          problema: "",
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
      lock: true
    };
  },
  methods: {
    getFonte(text) {
      console.log("aaaaaaaa");

      const url = `/api/fontes/${text}`;
      axios
        .get(url)
        .then(response => {
          console.log("deu boa");
          this.form.fonte = response.data.data;
          
          // this.form.fonte = response.data.data;
          console.log(response.data.data);
        })
        .catch(error => {
          console.log("erroo");
          
          console.log(error.response);
        });
    },
    async searchLike(input) {
      if (input.length < 1) return [];
      const url = `/api/fontes/search?query=${input}&attribute=cod_font`;
      const arr = await axios
        .get(url)
        .then(response => {
          return response.data.data;
        })
        .catch(error => {
          console.log(error.response);
        });
      console.log(arr);
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
    onSubmit(evt) {
      axios
        .post("/api/fontes", this.form.fonte)
        .then(response => console.log(response.data));
    },
    onReset(evt) {
      evt.preventDefault();
      this.form = _.mapValues(this.form, () => "");
      // Trick to reset/clear native browser form valeventation state
      this.show = false;
      this.lock = true;
      this.$nextTick(() => {
        this.show = true;
      });
    },
    onFilled(text) {
      if (text !== "") {
        this.lock = false;
      } else {
        this.lock = true;
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