<template>
  <div>
    <b-table 
    sticky-header 
    striped 
    bordered 
    outlined 
    :items="items"
    :fields="fields" 
    head-variant="dark"></b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fields: [
        {
          key: "cod_font",
          sortable: true,
          label: "Código Fonte"
        },
        {
          key: "cod_interno",
          sortable: true,
          label: "Código Interno"
        },
        {
          key: "modelo",
        },        
        {
          key: "fabricante",
        },
        {
          key: "desc_problema",
          label: "Problema"
        },
        {
          key: "peças",
        },
        {
          key: "status",
        },        
        {
          key: "created_at",
        },
      ],
      items: [
        {
          id: 1,
          cod_interno: "codduwia2",
          cod_font: "duhxauwghd",
          desc_problema: "queimado",
          peças: "parafusoaa30",
          status: "ok",
          created_at: "2020-06-30 18:25:23",
          updated_at: "2020-06-30 18:25:25",
          modelo: "modelo213",
          fabricante: "fabricante2321"
        },
        {
          id: 2,
          cod_interno: "dhjavw23",
          cod_font: "udwga2312",
          desc_problema: "Fritou",
          peças: "capacitor",
          status: "nok",
          created_at: "2020-06-30 18:30:44",
          updated_at: "2020-06-30 18:30:47",
          modelo: "modelb",
          fabricante: "novo_fabricante"
        }
      ]
    };
  }
};
</script>
