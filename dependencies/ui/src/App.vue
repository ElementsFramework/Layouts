<template>
  <div class="flex-container">
    <ui-element-picker class="element-picker" :uiElements="uiElements"></ui-element-picker>
    <draggable class="draggable main" :list="layout" :options="{group: 'ui-elements'}">
      <ui-element v-for="m in layout" v-if="m !== undefined" :key="m.id" :elementDefinition.sync="m"></ui-element>
    </draggable>
  </div>
</template>

<script>
  import EventBus from './event-bus'

  export default {
    name: 'app',
    props: ['layout', 'uiElements', 'submitUrl'],
    methods: {
      submitChanges () {
        this.$root.$http.post(this.submitUrl, this.layout)
      },
      removeUIElement (removedId, list = null) {
        if (list === null) {
          list = this.layout
        }
        for (var key in list) {
          if (list.hasOwnProperty(key) === false) {
            continue
          }
          if (list[key].contentData !== undefined && list[key].contentData !== null) {
            for (var childAreaKey in list[key].contentData) {
              this.removeUIElement(removedId, list[key].contentData[childAreaKey])
            }
          }
          if (list[key].id === removedId) {
            this.$delete(list, key)
          }
        }
      }
    },
    created () {
      var self = this
      EventBus.$on('elementDeleted', self.removeUIElement)
      EventBus.$on('submitChanges', self.submitChanges)
    }
  }
</script>

<style>
  html,
  body {
    height: 100%;
    padding: 0;
    margin: 0;
  }

  .flex-container {
    min-height: 100%;
    display: -ms-flexbox;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-box;
    display: box;
    -ms-flex-direction: row;
    -webkit-box-orient: horizontal;
    -moz-box-orient: horizontal;
    -ms-box-orient: horizontal;
    box-orient: horizontal;
  }

  .element-picker {
    background: #2c3e50;
    width: 250px;
    -ms-flex: 0 250px;
    -webkit-box-flex: 0;
    -moz-box-flex: 0;
    -ms-box-flex: 0;
    box-flex: 0;
  }

  .main {
    -ms-flex: 1;
    -webkit-box-flex: 1;
    -moz-box-flex: 1;
    -ms-box-flex: 1;
    box-flex: 1;
  }

  div.draggable {
    border: 2px #dde4e8 dashed;
    border-radius: 5px;
    min-height: 100px;
  }
</style>