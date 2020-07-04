<template>
  <div class="mx-5">
    <b-form @submit.prevent="onSubmit" @reset="onReset" v-if="show" ref="form">
      <div class="row">
        <b-form-group label="Código da fonte:" class="col-sm-6">
          <b-form-input
            v-model="form.cod_font"
            type="text"
            index="1"
            @update="onFilled($event)"
            @keyup.enter.native="FocusNextElement($event)"
            required
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Código interno:" label-for="cod_interno" class="col-sm-6">
          <b-form-input
            event="cod_interno"
            type="text"
            index="2"
            v-model="form.cod_interno"
            @keyup.enter.native="FocusNextElement($event)"
            required
            :disabled="lock"
          ></b-form-input>
        </b-form-group>
      </div>

      <div class="row">
        <b-form-group label="Modelo:" class="col-sm-6">
          <b-form-input
            v-model="form.modelo"
            :disabled="lock"
            @keyup.enter.native="FocusNextElement($event)"
            index="3"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Fabricante:" class="col-sm-6">
          <b-form-input
            v-model="form.fabricante"
            :disabled="lock"
            @keyup.enter.native="FocusNextElement($event)"
            index="4"
          ></b-form-input>
        </b-form-group>
      </div>

      <div class="row">
        <b-form-group label="Descrição problema:" class="col-sm-6">
          <b-form-input
            v-model="form.problema"
            :disabled="lock"
            @keyup.enter.native="FocusNextElement($event)"
            index="5"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Peças utilizadas:" class="col-sm-6">
          <b-form-input
            event="peças"
            v-model="form.peças"
            :disabled="lock"
            @keyup.enter.native="FocusNextElement($event)"
            index="6"
          ></b-form-input>
        </b-form-group>
      </div>

      <div class="row">
        <b-form-group class="col-sm-6" label="Valor:">
          <money
            v-model="form.valor"
            v-bind="money"
            :disabled="lock"
            class="form-control"
            maxlength="9"
            index="7"
          ></money>
        </b-form-group>

        <b-form-group class="col-sm-6" label="Status:">
          <b-form-select :options="statuses" v-model="form.status" :disabled="lock" required></b-form-select>
        </b-form-group>
      </div>

      <b-button type="submit" variant="primary" @click.prevent="">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>

<script>
import { Money } from "v-money";

export default {
  components: { Money },
  data() {
    return {
      form: {
        cod_font: "",
        cod_interno: "",
        modelo: "",
        fabricante: "",
        problema: "",
        peças: "",
        status: "",
        valor: 0
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
    onSubmit(evt) {
      alert(JSON.stringify(this.form));
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
    FocusNextElement(event) {
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