<script>
  var Loading = {
    template: `<div>Loading...</div>`
  }
  export default {
    name: 'inner-content',
    functional: true,
    props: ['elementDefinition'],
    render (h, context) {
      const props = context.props
      const template = props.elementDefinition.content
      const dynComponent = {
        template: template,
        data () {
          var data = props
          data.dragOptions = {
            group: 'ui-elements'
          }
          return data
        }
      }
      const component = template ? dynComponent : Loading
      return h(component)
    }
  }
</script>