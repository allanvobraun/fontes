<template>
  <b-form
    @submit.prevent="onSubmit"
    @reset.prevent="onReset"
    ref="form"
    autocomplete="off"
  >
    <div class="row">
      <b-form-group label="N/S Rework:" class="col-sm-6">
        <auto-complete-n-s-rework
          v-if="action === 'save'"
          index="1"
          v-model="form.fonte.cod_interno"
          @update="onFilled"
          @keyup.enter.native="focusNextElement($event)"
          @result-selected="getFonte"
          required
        ></auto-complete-n-s-rework>
        <b-form-input
          v-else
          index="1"
          v-model="form.fonte.cod_interno"
          @keyup.enter.native="focusNextElement($event)"
          required
        ></b-form-input>
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

</template>

<script>
import {Money} from "v-money";
import AutoCompleteNSRework from "components/search/AutoCompleteNSRework.vue";
import notify from "utils/notify";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {Money, AutoCompleteNSRework},
  props: {
    action: {
      type: String,
      default: 'save'
    },
  },
  data() {
    return {
      fonteEncontradaStatus: false,
      form: {
        // foi achada  a fonte no banco
        fonte: {
          cod_font: "",
          cod_interno: "",
          modelo: "",
          fabricante: ""
        },
        reparo: {
          desc_problema: "",
          peças: "",
          status: "OK",
          valor: 0
        }
      },
      statuses: ["OK", "NOK"],
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
  destroyed() {
    this.resetState();
  },
  computed: {
    ...mapGetters('reparoForm', ["fonteObject", "reparoObject"]),
  },
  methods: {
    ...mapActions('reparoForm', ['submitReparo', 'submitFonte', 'getFontByCod', 'resetState']),

    getFonte(text) {
      this.getFontByCod(text).then(() => {
          this.lock.fonte = true;
          this.fonteEncontradaStatus = true;
          notify.info('Fonte encontrada!');
        }).catch(() => {});
    },

    checkTarget(e) {
      // checa se o click veio do mause ou se foi do browser (0 é do browser)
      if (e.detail == 0) e.preventDefault();
    },

    setFormLock(lock) {
      this.lock.fonte = lock;
      this.lock.reparo = lock;
    },

    handleError(error, tituloMensagem) {
      if (!error) {
        notify.error('Erro desconhecido');
      }
      const errorText = this.$helpers.getErroString(error);
      notify.error(tituloMensagem, errorText);
      throw new Error(tituloMensagem);
    },

    async onSubmit() {
      let fonte_data;
      let reparo_data;

      //só tenta salvar a fonte se ja não foi auto preenchida
      if (this.fonteEncontradaStatus === false) {
        try {
          fonte_data = await this.submitFonte(this.form.fonte);
        } catch (error) {
          this.handleError(error?.response, "Erro ao gravar a fonte!");
        }
      }

      try {
        reparo_data = await this.submitReparo(this.form.reparo);
      } catch (error) {
        this.handleError(error?.response, "Erro ao gravar o reparo!");
      }

      this.notifySavedEntities(fonte_data, reparo_data);
      this.onReset();
    },

    notifySavedEntities(fonte_data, reparo_data) {
      const fonte_txt = fonte_data ? "Fonte salva com sucesso" : "";
      const reparo_txt = reparo_data ? "Reparo da fonte salvo com sucesso" : "";
      const responte_txt = `${fonte_txt}\n${reparo_txt}`;

      notify.sucess('Enviado com sucesso!', responte_txt);
    },

    onReset() {
      this.cleanFonte(true);
      this.form.reparo = _.mapValues(this.form.reparo, () => "");
      this.form.reparo.status = 'OK';
      this.setFormLock(true);
    },

    cleanFonte(limparCod) {
      const {cod_interno} = this.form.fonte;
      this.form.fonte = _.mapValues(this.form.fonte, () => "");

      if (!limparCod) {
        this.form.fonte.cod_interno = cod_interno;
      }
      this.fonteEncontradaStatus = false;
    },

    onFilled(text) {
      this.fonteEncontradaStatus = false;
      if (text !== "") {
        this.setFormLock(false);
        return;
      }
      this.setFormLock(true);
      this.cleanFonte(false);
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
  },
  watch: {
    fonteObject(newFonte) {
      Object.assign(this.form.fonte, newFonte);
    },
    reparoObject(newReparo) {
      Object.assign(this.form.reparo, newReparo);
    },
  }
};
</script>
