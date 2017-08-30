<template>
    <div class="ui-element-thumbnail">
      <div class="icon" v-html="icon"></div>
      <div class="name">{{ type }}</div>
    </div>
</template>

<script>
export default {
  name: 'ui-element-thumbnail',
  props: ['type', 'icon'],
  computed: {
    hasSlotData () {
      return !!this.$slots.content
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  div.ui-element-thumbnail {
    background-color: #ecf0f1;
    color: #2c3e50;
    width: 100px;
    margin: 12.5px;
    display: inline-block;
    box-sizing: border-box;
  }
  div.ui-element-thumbnail .icon {
    font-size: 2em;
    text-align: center;
  }
  div.ui-element-thumbnail .name {
    text-align: center;
    font-size: 1em;
  }
</style>
