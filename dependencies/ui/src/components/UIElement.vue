<template>
  <div class="ui-element-wrapper">
    <sweet-modal :ref="elementDefinition.id"overlay-theme="dark" v-if="elementDefinition.settings !== undefined">
      <vue-form-generator :schema="elementDefinition.settings.definition" :model="elementDefinition.settings.content" :options="formOptions"></vue-form-generator>
    </sweet-modal>
    <a class="settings" href="#" v-if="elementDefinition.settings !== undefined" v-on:click="openModal(elementDefinition.id)"><i class="fa fa-cog"></i></a>
    <a class="delete" href="#" v-on:click="removeUIElement(elementDefinition.id)"><i class="fa fa-trash"></i></a>
    <div class="ui-element slotless" v-if="elementDefinition.content === undefined">
      <div class="icon" v-html="elementDefinition.icon"></div>
      <div class="name">{{ elementDefinition.name }}</div>
    </div>
    <div class="ui-element slotted" v-if="elementDefinition.content !== undefined">
      <div class="toolbar">
        <div class="icon" v-html="elementDefinition.icon"></div> {{ elementDefinition.name }}
      </div>
      <div class="content">
        <inner-content v-if="elementDefinition.content !== undefined" :elementDefinition="elementDefinition"></inner-content>
      </div>
    </div>
  </div>
</template>

<script>
import InnerContent from './InnerContent.vue'
import 'vue-form-generator/dist/vfg-core.css'
import EventBus from '../event-bus'

export default {
  name: 'ui-element',
  components: {
    'inner-content': InnerContent
  },
  props: ['elementDefinition'],
  data () {
    return {
      formOptions: {
        validateAfterLoad: true,
        validateAfterChanged: true
      }
    }
  },
  methods: {
    openModal (refId) {
      this.$refs[refId].open()
    },
    removeUIElement (removedId) {
      EventBus.$emit('elementDeleted', removedId)
    }
  },
  computed: {
    hasSlotData () {
      return !!this.$slots.content
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  div.ui-element {
    background-color: #ecf0f1;
    color: #2c3e50;
    width: 100%;
    margin-bottom: 10px;
    box-sizing: border-box;
  }

  div.ui-element-wrapper {
    position: relative;
    font-family: sans-serif;
  }
  div.ui-element-wrapper .delete {
    height: 25px;
    width: 25px;
    color: #ecf0f1;
    background-color: #2c3e50;
    display: inline-block;
    position: absolute;
    top: 0;
    right: 0;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    line-height: 25px;
  }
  div.ui-element-wrapper .settings {
    height: 25px;
    width: 25px;
    color: #ecf0f1;
    background-color: #2c3e50;
    display: inline-block;
    position: absolute;
    top: 0;
    right: 25px;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    line-height: 25px;
  }

  div.ui-element.slotless {
    padding: 10px;
  }
  div.ui-element.slotless .icon {
    font-size: 4em;
    text-align: center;
  }
  div.ui-element.slotless .name {
    text-align: center;
    font-size: 1.5em;
  }

  div.ui-element.slotted .toolbar {
    padding: 5px;
    color: #ecf0f1;
    background-color: #2c3e50;
  }
  div.ui-element.slotted .toolbar .icon {
    display: inline-block;
  }
  div.ui-element.slotted .content {
    padding: 10px;
  }

  .sweet-modal-overlay {
    position: inherit;
    width: 100%;
  }
</style>
