# Layout Builder UI
This is the frontend portion of Elements Framework Layouts component.

![](https://zippy.gfycat.com/IgnorantPartialKentrosaurus.gif)

The Layout Builder UI is a user interface which takes in JSON component definitions and the initial layout JSON and visualizes the modules. The builder then allows for adding/removing/reordering of elements and editing their settings. The result is a layout JSON that will be submitted to the given URL.

Since the layout builder only modifies the layout JSON it is not coupled to the Elements Framework Layouts component implementation. Instead, using the parameters below it is possible to implement the backend persistance and rendering yourself allowing for usage in any framework.

## Quick start
Layout Builder UI is built with VueJS 2 and the local setup is really simple. Just install the dependencies using NPM and run the development or production builds.

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build
```

## Parameter specification
Layout Builder UI takes in a couple of parameters that are needed to initialize the builder and produce the output layouts JSON.

- **submitUrl** - This URL will be used for the "Save Changes" button. The layouts JSON is submitted via a POST request to that URL so your backend can do the necessary steps to process it.
- **uiElements** - This the *elements definition JSON* which is used for creating the elements library on the left. The elements library allows for adding new elements to the layout. The definition JSON is explained in the next section in more detail.
- **layout** - This is the layout JSON that describes the actual page that the builder will display initially and allow the user to edit. This layout JSON is explained in the next section in more detail.

### Elements Definition JSON
This JSON is sent to the layout builder so the library of the elements on the left can be built. This library allows the user to drag and drop new components in the layout.

The definition JSON contains multiple component defintions in an array. Each definition has the following parameters:

- **[REQUIRED] name** - name of the component that will be shown to the user.
- **[REQUIRED] icon** - icon HTML that will be used as an thumbnail for displaying the module
- **[OPTIONAL] content** - this parameter is used for elements that need to have other elements nested inside of them (ex. column block that allows for adding components to multiple columns). See the example definition JSON below for how to construct such an element.
- **[OPTIONAL] contentData** - used for storing the data/lists needed for the content property. In the example definition JSON below it stores two lists of components - one for each column that the component exposes.
- **[OPTIONAL] settings** - this parameter is used for components that need a configuration form attached to them. It contains two different parts:  
	- **content** - the default setting parameters of the component. If no default values are needed, do not include the key of that input field.
	- **definition** - this JSON defines the settings form that will be rendered for the component. Details of the JSON format can be found at the following link: https://github.com/icebob/vue-form-generator

**Example definition JSON**:

``` javascript
[
    {
        name: '2 columns',
        icon: '<i class="fa fa-columns"></i>',
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
            col1: [],
            col2: []
        },
    },
    {
        name: 'Contact form',
        icon: '<i class="fa fa-envelope"></i>',
        settings: {
            content: {
                destination_email: "default@email.com"
            },
            definition: {
                fields: [{
                    type: 'input',
                    inputType: 'text',
                    label: 'Destination e-mail',
                    model: 'destination_email',
                    validator: VueFormGenerator.validators.email
                }]
            }
        }
    }
]
```

### Layout Defintion JSON
The layout definition JSON defines how the actual page you are building looks. It's structure is the same as the definition JSON, except for the following differences:  

- An ID string is added to each element for internal purposes. This ID string will be added to the output but you can safely ignore it as it provides no value.  
- settings.content object is filled with the values the user entered or were unmodified from the last layout load.  
- contentData property is filled with the component definitions the user dragged in the component - allowing you to construct the rendering tree in the backend.

### Custom Properties
If the above mentioned definition does not work for a specific use case it is possible to add custom properties to components. You just need to add a new key to the component definition and that property will also be available in the output.
