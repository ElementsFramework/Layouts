<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Layout Builder</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('vendor/elements-framework/layout/ui/css/app.f2c41a630cebcbbc713ffdd4f2828eb8.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app"></div>
    <script src="{{ asset('vendor/elements-framework/layout/ui/js/vfg-core.js') }}"></script>
    <script>
        window.submissionUrl = "{{ route('elements.layout-builder.save', ['id' => $layout->id]) }}";
        window.uiElements = [
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
                }
            },
            {
                name: 'Contact form',
                icon: '<i class="fa fa-envelope"></i>',
                settings: {
                    content: {
                        destination_email: 'default@email.com'
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
        ];
        window.layout = {!! $layout->content !!};
    </script>
    <script src="{{ asset('vendor/elements-framework/layout/ui/js/manifest.c2c8e5e757af47608ff8.js') }}"></script>
    <script src="{{ asset('vendor/elements-framework/layout/ui/js/vendor.64bc068fdea020983909.js') }}"></script>
    <script src="{{ asset('vendor/elements-framework/layout/ui/js/app.d564626814a92e0fb1fb.js') }}"></script>
</body>
</html>
