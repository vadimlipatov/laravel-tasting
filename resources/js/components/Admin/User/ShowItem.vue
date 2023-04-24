<template>
  <div @click="toggleCard()" v-if="toggle" class="admin-card">
    <div class="header d-flex justify-content-between">
      <p class="title">{{ product.title }} ({{ product.description }})</p>
      <p class="rate">{{ product.average }}</p>
    </div>
    <div class="rating d-flex justify-content-between">
      <div class="rating-item">
        <p class="rating-header">Тов. вид</p>
        <p class="rate">{{ product.commercial }}</p>
      </div>
      <div class="rating-item">
        <p class="rating-header">Внеш. вид</p>
        <p class="rate">{{ product.appearance }}</p>
      </div>
      <div class="rating-item">
        <p class="rating-header">Разрез</p>
        <p class="rate">{{ product.cut }}</p>
      </div>
      <div class="rating-item">
        <p class="rating-header">Цвет</p>
        <p class="rate">{{ product.color }}</p>
      </div>
      <div class="rating-item">
        <p class="rating-header">Вкус</p>
        <p class="rate">{{ product.taste }}</p>
      </div>
      <div class="rating-item">
        <p class="rating-header">Запах</p>
        <p class="rate">{{ product.smell }}</p>
      </div>
      <div class="rating-item">
        <p class="rating-header">Консист.</p>
        <p class="rate">{{ product.consistency }}</p>
      </div>
    </div>
    <div class="comment">
      <p class=""><b>Комментарий:</b> {{ product.comment }}</p>
      <p class=""><b>Примечание:</b> {{ product.note }}</p>
    </div>
    <div class="date">
      <p class="">
        <b>Дата голосования:</b>
        {{ product.date.replace(/(\d+)-(\d+)-(\d+)/, "$3.$2.$1") }}
      </p>
      <p class="">
        <b>Дегустация:</b
        ><span>
          Дегустация от
          {{ product.date.replace(/(\d+)-(\d+)-(\d+)/, "$3.$2.$1") }}</span
        >
      </p>
    </div>
  </div>

  <div
    @click="toggleCard()"
    v-if="!toggle"
    class="admin-card admin-card-short d-flex justify-content-between"
  >
    <div class="admin-card-short-body">
      <p class="admin-card-short-header">
        {{ product.title }} ({{ product.description }})
      </p>
      <div class="date">
        <p class="">
          Дата голосования:
          {{ product.date.replace(/(\d+)-(\d+)-(\d+)/, "$3.$2.$1") }}
        </p>
        <p class="">
          Дегустация:<span>
            Дегустация от
            {{ product.date.replace(/(\d+)-(\d+)-(\d+)/, "$3.$2.$1") }}</span
          >
        </p>
      </div>
    </div>
    <div class="rate">{{ product.average }}</div>
  </div>
</template>

<script>
export default {
  props: ["product"],
  data() {
    return {
      toggle: false,
    };
  },
  mounted() {},
  computed: {},
  methods: {
    toggleCard() {
      this.toggle = !this.toggle;
    },
  },
};
</script>
