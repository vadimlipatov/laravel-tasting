<template>
  <div class="container">
    <div class="row">
      <div class="col-12 tasting-product-show">
        <p class="">Продукция:</p>
        <p class="">{{ product.title }}</p>
        <div v-for="image in images" class="images">
          <a
            :href="`/storage/${image.image}`"
            data-fancybox="gallery"
            :key="image.id"
          >
            <img :src="`/storage/${image.image}`" alt="food" />
          </a>
        </div>

        <form method="POST" action="">
          <div class="rating">
            <p class="rating-title">Товарный вид</p>
            <div class="rating-input">
              <input
                type="range"
                step="0.1"
                min="0"
                max="5"
                name="commercial"
                v-model="commercial"
              />
              <span id="commercialSpan">{{
                Number(commercial).toFixed(1)
              }}</span>
            </div>
          </div>
          <div class="rating">
            <p class="rating-title">Внешний вид</p>
            <div class="rating-input">
              <input
                type="range"
                step="0.1"
                min="0"
                max="5"
                v-model="appearance"
                name="appearance"
              />
              <span>{{ Number(appearance).toFixed(1) }}</span>
            </div>
          </div>
          <div class="rating">
            <p class="rating-title">На разрезе</p>
            <div class="rating-input">
              <input
                type="range"
                step="0.1"
                min="0"
                max="5"
                v-model="cut"
                name="cut"
              />
              <span>{{ Number(cut).toFixed(1) }}</span>
            </div>
          </div>
          <div class="rating">
            <p class="rating-title">Цвет</p>
            <div class="rating-input">
              <input
                type="range"
                step="0.1"
                min="0"
                max="5"
                v-model="color"
                name="color"
              />
              <span>{{ Number(color).toFixed(1) }}</span>
            </div>
          </div>
          <div class="rating">
            <p class="rating-title">Вкус</p>
            <div class="rating-input">
              <input
                type="range"
                step="0.1"
                min="0"
                max="5"
                v-model="taste"
                name="taste"
              />
              <span id="tasteSpan">{{ Number(taste).toFixed(1) }}</span>
            </div>
          </div>
          <div class="rating">
            <p class="rating-title">Запах</p>
            <div class="rating-input">
              <input
                type="range"
                step="0.1"
                min="0"
                max="5"
                v-model="smell"
                name="smell"
              />
              <span>{{ Number(smell).toFixed(1) }}</span>
            </div>
          </div>
          <div class="rating">
            <p class="rating-title">Консистенция</p>
            <div class="rating-input">
              <input
                type="range"
                step="0.1"
                min="0"
                max="5"
                v-model="consistency"
                name="consistency"
              />
              <span>{{ Number(consistency).toFixed(1) }}</span>
            </div>
          </div>

          <div class="comment-form">
            <label for="product-comment">Комментарий:</label>
            <div class="comment">
              <input
                type="text"
                class="form-input"
                name="comment"
                placeholder=""
                id="product-comment"
              />
            </div>

            <label for="product-note">Примечание:</label>
            <div class="note">
              <input
                type="text"
                class="form-input"
                name="note"
                placeholder=""
                id="product-note"
              />
            </div>

            <button
              @click.prevent="createRate()"
              type="submit"
              :disabled="block"
              :class="
                block
                  ? 'btn-disabled form-btn form-btn-red'
                  : 'form-btn form-btn-red'
              "
            >
              Отправить
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tasting: {},
      images: [],
      product: {},
      block: false,
      commercial: 4.6,
      appearance: 4.6,
      cut: 4.6,
      color: 4.6,
      taste: 4.6,
      smell: 4.6,
      consistency: 4.6,
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    async getData() {
      const user_id = document.getElementById("userId").value;
      const tastingId = window.location.pathname.split("/")[3];
      const productId = window.location.pathname.split("/")[4];
      const res = await axios.post(`/api/tastor/${tastingId}/${productId}`, {
        user_id,
      });
      this.tasting = res.data.tasting;
      this.images = res.data.images;
      this.product = res.data.product;
      this.block = !!res.data.blockButton;

      // console.log(res);
    },
    async createRate() {
      const tastingId = window.location.pathname.split("/")[3];
      const productId = window.location.pathname.split("/")[4];
      const res = await axios.post(
        `/api/tastor/${tastingId}/${productId}/create`,
        {
          commercial: this.commercial,
          appearance: this.appearance,
          cut: this.cut,
          color: this.color,
          taste: this.taste,
          smell: this.smell,
          consistency: this.consistency,
          userId: document.getElementById("userId").value,
        }
      );
      // console.log(res);
      this.block = true;
    },
  },
};
</script>
