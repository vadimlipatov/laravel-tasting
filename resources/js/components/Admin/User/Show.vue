<template>
  <div class="row admin-user-show">
    <div class="col-12">
      <p class="header text-capitalize">{{ userName }}</p>
      <p class="activity">Последняя активность: {{ lastActivityDate }}</p>

      <p class="header">Поиск</p>
      <!-- for -->
      <div class="filter">
        <div class="search">
          <input
            placeholder="Название продукции / дегустации"
            type="text"
            class="w-100"
            name="search"
            id="search"
            v-model="search"
            @input="filterProducts()"
          />
        </div>

        <div>
          <input
            placeholder="Дата “от”"
            type="date"
            name="dateFrom"
            v-model="dateFrom"
            @change="filterProductsByDate()"
          />
          <input
            placeholder="Дата “до”"
            type="date"
            name="dateTo"
            v-model="dateTo"
            @change="filterProductsByDate()"
          />
        </div>
      </div>

      <p class="header-story">История дегустаций</p>
      <div v-for="product in filteredProducts" :key="product.id">
        <ProductItem :product="product" />
      </div>
    </div>
  </div>
</template>

<script>
import ProductItem from "./ShowItem.vue";
export default {
  components: { ProductItem },
  data() {
    return {
      lastActivityDate: null,
      products: [],
      filteredProducts: [],
      userName: null,
      search: "",
      dateFrom: "",
      dateTo: "",
    };
  },
  mounted() {
    this.getData();
  },
  updated() {},
  computed: {},
  methods: {
    async getData() {
      const userId = window.location.pathname.split("/")[3];
      const res = await axios.post(`/api/users/products`, {
        userId,
      });
      // console.log(res.data);
      this.lastActivityDate = res.data.lastActivityDate;
      this.userName = res.data.userName;
      this.filteredProducts = res.data.products;
      this.products = res.data.products;
    },

    filterProducts() {
      this.filteredProducts = [...this.products].filter((el) => {
        return el.title.toLowerCase().includes(this.search);
      });
      this.$forceUpdate();
      console.log(this.filteredProducts);
    },

    filterProductsByDate() {
      this.filteredProducts = [...this.products].filter((el) => {
        return el.date >= this.dateFrom && el.date <= this.dateTo;
      });
    },
  },
};
</script>
