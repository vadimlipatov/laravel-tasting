<template>
  <div class="row">
    <div class="col-12 tasting-product-show">
      <p class="">Продукция:</p>
      <p class="">{{ product.title }}</p>
      <div class="images">
        <a
          v-for="image in images"
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
            <span id="commercialSpan">{{ Number(commercial).toFixed(1) }}</span>
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
              v-model="comment"
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
              v-model="note"
            />
          </div>

          <button
            @click.prevent="createRate"
            type="submit"
            :disabled="disabled"
            :class="
              disabled
                ? 'btn-disabled form-btn form-btn-red static'
                : 'form-btn form-btn-red static'
            "
          >
            {{ disabled ? "Вы уже голосовали" : "Отправить" }}
          </button>
        </div>
      </form>

      <div style="display: none; width: 500px" id="hidden">
        <h2>Спасибо, Ваш голос принят!</h2>
        <div class="flex justify-content-evenly mt-4" style="display: flex">
          <button data-fancybox-close class="form-btn w-50 red">ОК</button>
        </div>
      </div>
      <button id="popup" style="display: none" href="#hidden" data-fancybox>
        Открыть Fancybox
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tastingId: null,
      productId: null,
      userId: null,
      tasting: {},
      images: [],
      product: {},
      disabled: false,
      commercial: 4.6,
      appearance: 4.6,
      cut: 4.6,
      color: 4.6,
      taste: 4.6,
      smell: 4.6,
      consistency: 4.6,
      comment: null,
      note: null,
    };
  },
  mounted() {
    this.userId = document.getElementById("userId").value;
    this.tastingId = window.location.pathname.split("/")[3];
    this.productId = window.location.pathname.split("/")[4];
    this.getData();
  },
  methods: {
    async getData() {
      const res = await axios.post(
        `/api/tastor/${this.tastingId}/${this.productId}`,
        {
          user_id: this.userId,
        }
      );
      this.tasting = res.data.tasting;
      this.product = res.data.product;
      this.images = res.data.images;
      this.disabled = !!res.data.blockButton;
    },
    async createRate() {
      const data = {
        commercial: this.commercial,
        appearance: this.appearance,
        cut: this.cut,
        color: this.color,
        taste: this.taste,
        smell: this.smell,
        consistency: this.consistency,
        comment: this.comment,
        note: this.note,
        userId: this.userId,
      };

      const res = await axios.post(
        `/api/tastor/${this.tastingId}/${this.productId}/create`,
        data
      );

      if ((res.data.message = "ok")) {
        document.getElementById("popup").click();
        this.disabled = true;
      }
    },
  },
};
</script>
<style scoped>
button[type="submit"]:hover {
  opacity: 0.8;
}
button[type="submit"]:focus {
  outline: none;
  box-shadow: 0 0 0 4px #e8a1a7;
}
</style>
