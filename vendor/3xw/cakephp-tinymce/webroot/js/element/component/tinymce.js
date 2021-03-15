(function(scope, Vue){

  //window helper
  scope.slug = function(str)
  {
    return str.replace(/\./gi, '')
  }

  // Vue component
  Vue.component('tinymce', {
    template: '#tinymce',
    props: {
      id: String,
      init: {
        type: Object,
        label: String,
        class: String,
        default: function(){return{}}
      }
    },
    created: function()
    {
      if(!scope.vueTinymce) scope.vueTinymce = {}
      scope.vueTinymce[this.id] = this
    },
    computed:
    {
      slug: function()
      {
          return scope.slug(this.id)
      },
      name: function(id)
      {
        var sections = this.id.split('.');
        var name = '';
        for(i = 0;i < sections.length;i++){
          if(i > 0){
            name += '['+sections[i]+']';
          }else{
            name += sections[i];
          }
        }
        return name
      },
      cInit: function()
      {
        var field = this.name;
        return Object.assign({
          'selector': '#'+scope.slug(this.id),
          'theme_url': this.$root.$el.dataset.webroot + 'trois/tinymce/js/tinymce/themes/modern/theme.js',
          'skin_url': this.$root.$el.dataset.webroot + 'trois/tinymce/js/tinymce/skins/lightgray/',
          'paste_enable_default_filters': true,
          'paste_preprocess': this.pastePreprocess,
          'relative_urls': false,
          'setup':  function(editor) {
            editor.on('submit', function(e) {
              e.preventDefault();
              $('[name="'+scope.slug(this.id)+'"]').attr('name', field).attr('value', this.getContent())
              $('form').submit()
            });
          }
        }, this.init)
      }
    },
    mounted: function()
    {
      scope.tinymce.baseURL = this.$root.$el.dataset.webroot + 'trois/tinymce/js/tinymce'
      scope.tinymce.suffix = '.min'
      scope.tinymce.init(this.cInit)

    },
    methods: {
      pastePreprocess: function(plugin, args)
      {
        args.content = args.content.replace(/<[^>]*>/g, function (match) {
          match = match.replace(/ ([^=]+)="[^"]*"/g, function (match2, attributeName) {
            if (['alt', 'href', 'src', 'title', 'target'].indexOf(attributeName) !== -1) {
              return match2;
            }
            return '';
          });
          return match;
        });
        args.content = args.content.replace(/<(div|style|meta|link|pclass|span|svg|path|pre|code).*?>/gi, '');
      }
    }
  });

})(window, Vue);
