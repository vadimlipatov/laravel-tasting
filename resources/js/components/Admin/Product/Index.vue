<template>
  <div class="container">
    <div class="row admin-show-products">
      <div class="col-12">
        <h1 class="form-header text-center">СПИСОК ПРОДУКЦИИ</h1>
        <p class="header">Поиск</p>

        <div class="filter search">
          <input
            placeholder="Название продукции"
            type="text"
            class="w-100"
            name="search"
            id="search"
            v-model="search"
            @input="filterProducts()"
          />
        </div>
        <div v-for="product in filteredProducts" :key="product.id">
          <div class="admin-card d-flex justify-content-between">
            <div class="align-self-center">
              <h3>
                <a :href="`./products/${product.id}`"
                  >{{ product.title }} ({{ product.description }})</a
                >
              </h3>
              <p class="activity mb-0">
                Последняя дегустация: {{ product.lastActivityDate }}
              </p>
            </div>
            <div class="delete align-self-center">
              <a :href="`./products/${product.id}/delete`">
                <button
                  @click.prevent="deleteProduct(product.id)"
                  type="submit"
                  class="border-0 bg-transparent delete-btn"
                >
                  <img src="@/../img/close.svg" alt="delete_btn" />
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <a href="./products/create">
          <button class="form-btn form-btn-red">ДОБАВИТЬ Продукцию</button>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      filteredProducts: [],
      search: "",
    };
  },
  mounted() {
    this.getData();
  },
  updated() {},
  computed: {},
  methods: {
    async getData() {
      const res = await axios.get(`/api/products`);
      // console.log(res.data.products);
      this.filteredProducts = res.data.products;
      this.products = res.data.products;
    },
    filterProducts() {
      this.filteredProducts = [...this.products].filter((el) => {
        return el.title.includes(this.search);
      });
      this.$forceUpdate();
      // console.log(this.filteredProducts);
    },
    async deleteProduct(id) {
      const res = await axios.post(`./products/${id}/delete`, {
        id,
      });
      location.reload();
    },
  },
};
</script>
