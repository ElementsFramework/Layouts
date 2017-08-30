<template>
  <div>
    <a href="#" v-on:click="saveChanges">Save Changes</a>
    <draggable @remove="listChanged"  :clone="clone" :list="uiElementsInternal" :options="dragOptions">
      <ui-element-thumbnail v-for="l in uiElementsInternal" :type="l.name" :key="l.name" :icon="l.icon" >
      </ui-element-thumbnail>
    </draggable>
  </div>
</template>

<script>
import EventBus from '../event-bus'

export default {
  name: 'ui-element-picker',
  props: ['uiElements'],
  mounted () {
    for (var key in this.uiElements) {
      this.uiElements[key].id = Math.random().toString(36).substring(2, 15)
    }
  },
  data () {
    return {
      dragOptions: {
        group: {
          name: 'ui-elements',
          pull: 'clone',
          put: false
        }
      },
      uiElementsInternal: this.uiElements
    }
  },
  methods: {
    listChanged (event) {
      for (var key in this.uiElementsInternal) {
        this.uiElementsInternal[key].id = Math.random().toString(36).substring(2, 15)
      }
      this.uiElementsInternal = this.uiElementsInternal.filter(Object)
      console.log(this.uiElementsInternal)
    },
    saveChanges () {
      EventBus.$emit('submitChanges')
    },
    clone: function (original) {
      var element = {}
      for (var key in original) {
        if (original.hasOwnProperty(key)) {
          element[key] = original[key]
        }
      }
      return element
    }
  }
}
</script>

<style scoped>
  a {
    display: block;
    width: 100%;
    padding: 5px;
    font-size: 18px;
    background-color: #ecf0f1;
    color: #2c3e50;
    text-align: center;
  }
</style>
