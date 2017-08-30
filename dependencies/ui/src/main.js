// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VueResource from 'vue-resource'
import App from './App'

Vue.config.productionTip = false

Vue.use(VueResource)

import UIElement from './components/UIElement'
Vue.component('ui-element', UIElement)
import UIElementThumbnail from './components/UIElementThumbnail'
Vue.component('ui-element-thumbnail', UIElementThumbnail)
import UIElementPicker from './components/UIElementPicker'
Vue.component('ui-element-picker', UIElementPicker)
import draggable from 'vuedraggable'
Vue.component('draggable', draggable)
import VueFormGenerator from 'vue-form-generator'
Vue.component('vue-form-generator', VueFormGenerator.component)
import { SweetModal } from 'sweet-modal-vue'
Vue.component('sweet-modal', SweetModal)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  data () {
    return {
      uiElements: [
        {
          name: 'Test 1',
          icon: '<i class="fa fa-camera"></i>'
        },
        {
          name: 'Test 2',
          icon: '<i class="fa fa-camera"></i>'
        }
      ],
      layout: [
        {
          id: Math.random().toString(36).substring(2, 15),
          name: 'test1',
          icon: '<i class="fa fa-camera"></i>',
          content: `<div class="row" slot="content" v-if="elementDefinition.contentData">
          <div class="col-md-6">
            <draggable class="draggable" :options="dragOptions" container-id="col1"
                       :list="elementDefinition.contentData.col1">
              <ui-element v-for="l in elementDefinition.contentData.col1" v-if="l !== undefined" :key="l.id" :elementDefinition.sync="l">
              </ui-element>
            </draggable>
          </div>
          <div class="col-md-6">
            <draggable class="draggable" :options="dragOptions" container-id="col2"
                       :list="elementDefinition.contentData.col2">
              <ui-element v-for="l in elementDefinition.contentData.col2" v-if="l !== undefined" :key="l.id" :elementDefinition.sync="l">
              </ui-element>
            </draggable>
          </div>
        </div>`,
          contentData: {
            col1: [{
              id: Math.random().toString(36).substring(2, 15),
              name: 'test1 > col1',
              icon: '<i class="fa fa-camera"></i>'
            }],
            col2: [{
              id: Math.random().toString(36).substring(2, 15),
              name: 'test1 > col2',
              icon: '<i class="fa fa-camera"></i>'
            }]
          },
          settings: {
            content: {},
            definition: {
              fields: [{
                type: 'input',
                inputType: 'text',
                label: 'ID',
                model: 'id',
                readonly: true,
                featured: false,
                disabled: true
              }, {
                type: 'input',
                inputType: 'text',
                label: 'Name',
                model: 'name',
                readonly: false,
                featured: true,
                required: true,
                disabled: false,
                placeholder: 'User\'s name',
                validator: VueFormGenerator.validators.string
              }, {
                type: 'input',
                inputType: 'password',
                label: 'Password',
                model: 'password',
                min: 6,
                required: true,
                hint: 'Minimum 6 characters',
                validator: VueFormGenerator.validators.string
              }, {
                type: 'input',
                inputType: 'number',
                label: 'Age',
                model: 'age',
                min: 18,
                validator: VueFormGenerator.validators.number
              }, {
                type: 'input',
                inputType: 'email',
                label: 'E-mail',
                model: 'email',
                placeholder: 'User\'s e-mail address',
                validator: VueFormGenerator.validators.email
              }, {
                type: 'checklist',
                label: 'Skills',
                model: 'skills',
                multi: true,
                required: true,
                multiSelect: true,
                values: ['HTML5', 'Javascript', 'CSS3', 'CoffeeScript', 'AngularJS', 'ReactJS', 'VueJS']
              }, {
                type: 'switch',
                label: 'Status',
                model: 'status',
                multi: true,
                readonly: false,
                featured: false,
                disabled: false,
                default: true,
                textOn: 'Active',
                textOff: 'Inactive'
              }]
            }
          }
        },
        {
          id: Math.random().toString(36).substring(2, 15),
          name: 'test2',
          icon: '<i class="fa fa-camera"></i>'
        },
        {
          id: Math.random().toString(36).substring(2, 15),
          name: 'test3',
          icon: '<i class="fa fa-camera"></i>'
        },
        {
          id: Math.random().toString(36).substring(2, 15),
          name: 'test4',
          icon: '<i class="fa fa-camera"></i>'
        }
      ],
      submissionUrl: 'http://igor-rinkovec.from.hr/hook.php'
    }
  },
  template: '<App :layout="layout" :submitUrl="submissionUrl" :uiElements="uiElements"/>',
  components: { App }
})
