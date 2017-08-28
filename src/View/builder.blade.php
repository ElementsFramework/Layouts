<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Layout Builder</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div id="app"></div>
    <script src="{{ asset('vendor/elements-framework/layout/ui/build/build.js') }}"></script>
    <script src="{{ asset('vendor/elements-framework/layout/ui/src/main.js') }}"></script>
    <script>
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
                    layout: {{ json_decode($layout->content) }},
            template: '<App :layout="layout" :submitUrl="submissionUrl" :uiElements="uiElements"/>',
            components: { App }
        });
    </script>
</body>
</html>
