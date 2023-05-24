<template>
  <div class="row admin-product-show">
    <div class="col-12">
      <div class="product-show-title d-flex justify-content-between">
        <div class="product-rate-description">
          <h1 v-if="product.description" class="text-capitalize">
            {{ product.title }} ({{ product.description }})
          </h1>
          <h1 v-else class="text-capitalize">
            {{ product.title }}
          </h1>
          <p class="activity">
            Последняя дегустация:
            {{ lastTastingDate.replace(/(\d+)-(\d+)-(\d+)/, "$3.$2.$1") }}
          </p>
        </div>
        <div class="product-rate-score align-self-center">
          {{ average.toFixed(2) }}
        </div>
      </div>
      <div></div>

      <div class="filter">
        <p class="header">Поиск</p>
        <div>
          <input
            placeholder="Дата “от”"
            type="date"
            name="dateFrom"
            v-model="dateFrom"
            @change="filterTastings()"
          />
          <input
            placeholder="Дата “до”"
            type="date"
            name="dateTo"
            v-model="dateTo"
            @change="filterTastings()"
          />
        </div>
      </div>

      <div class="history">
        <p class="header">История дегустаций</p>
        <div v-for="tasting in filteredTastings" :key="tasting.id">
          <div class="admin-card">
            <div class="header d-flex mb-0 justify-content-between">
              <p class="title">
                <!-- <a :href="`${product.id}/${tasting.id}`" -->
                <a href="#"
                  >{{ tasting.title }} от
                  {{ tasting.date.replace(/(\d+)-(\d+)-(\d+)/, "$3.$2.$1") }}</a
                >
              </p>
              <p class="rate mb-0">{{ tasting.average.toFixed(2) }}</p>
            </div>
            <div class="rating d-flex justify-content-between">
              <div class="rating-item">
                <p class="rating-header">Тов. вид</p>
                <p class="rate">{{ tasting.commercial.toFixed(2) }}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Внеш. вид</p>
                <p class="rate">{{ tasting.appearance.toFixed(2) }}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Разрез</p>
                <p class="rate">{{ tasting.cut.toFixed(2) }}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Цвет</p>
                <p class="rate">{{ tasting.color.toFixed(2) }}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Вкус</p>
                <p class="rate">{{ tasting.taste.toFixed(2) }}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Запах</p>
                <p class="rate">{{ tasting.smell.toFixed(2) }}</p>
              </div>
              <div class="rating-item">
                <p class="rating-header">Консист.</p>
                <p class="rate">{{ tasting.consistency.toFixed(2) }}</p>
              </div>
            </div>
            <p class="persons">
              Участников дегустации: {{ tasting.peopleCount }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tastings: [],
      product: {},
      lastTastingDate: "",
      average: 0,
      dateFrom: "",
      dateTo: "",
      filteredTastings: [],
    };
  },
  mounted() {
    this.getData();
  },
  updated() {
    console.log(this.dateFrom, this.dateTo);
  },
  computed: {},
  methods: {
    async getData() {
      const productId = window.location.pathname.split("/")[3];
      const res = await axios.post(`/api/products/${productId}`, {
        productId,
      });
      console.log(res.data);
      this.filteredTastings = res.data.tastings;
      this.tastings = res.data.tastings;
      this.product = res.data.product;
      this.average = res.data.average;
      this.lastTastingDate = res.data.lastTastingDate;
    },
    filterTastings() {
      this.filteredTastings = [...this.tastings].filter((el) => {
        return el.date >= this.dateFrom && el.date <= this.dateTo;
      });
      this.$forceUpdate();
      // console.log(this.filteredTastings);
    },
  },
};
</script>
