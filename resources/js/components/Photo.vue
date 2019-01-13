<template>
  <div class="photo">
    <figure class="photo__wrapper">
      <img
        class="photo__image"
        :class="imageClass"
        :src="item.url"
        :alt="`Photo by ${item.owner.name}`"
        @load="setAspectRatio"
        ref="image"
      >
    </figure>
    <RouterLink
      class="photo__overlay"
      :to="`/photos/${item.id}`"
      :title="`View the photo by ${item.owner.name}`"
    >
      <div class="photo__controls">
        <button
          class="photo__action photo__action--like"
          title="Like photo"
        >
          <i class="icon ion-md-heart"></i>12
        </button>
        <a
          class="photo__action"
          title="Download photo"
          @click.stop
          :href="`/photos/${item.id}/download`"
        >
          <i class="icon ion-md-arrow-round-down"></i>
        </a>
      </div>
      <div class="photo__username">
        {{ item.owner.name }}
      </div>
    </RouterLink>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      landscape: false,
      portrait: false
    }
  },
  computed: {
    imageClass () {
      return {
        // 横長クラス
        'photo__image--landscape': this.landscape,
        // 縦長クラス
        'photo__image--portrait': this.portrait
      }
    }
  },
  methods: {
    setAspectRatio () {
      if (! this.$refs.image) {
        return false
      }
      const height = this.$refs.image.clientHeight
      const width = this.$refs.image.clientWidth
      // 縦横比率 3:4 よりも横長の画像
      this.landscape = height / width <= 0.75
      // 横長でなければ縦長
      this.portrait = ! this.landscape
    }
  },
  watch: {
    $route () {
      // ページが切り替わってから画像が読み込まれるまでの間に
      // 前のページの同じ位置にあった画像の表示が残ってしまうことを防ぐ
      this.landscape = false
      this.portrait = false
    }
  }
}
</script>
