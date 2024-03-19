panel.plugin("storiedibit/newsletter-section", {
  blocks: {
    'newsletter-section': {
      computed: {
        color() {
          if (this.content.color === 'blue') {
            return '#07397E';
          } else if (this.content.color === 'violet') {
            return '#3c00bd';
          } else if (this.content.color === 'sky') {
            return 'rgb(1, 127, 167)';
          } else if (this.content.color === 'red') {
            return 'rgb(192, 0, 0)';
          } else if (this.content.color === 'brown') {
            return 'rgb(115, 3, 71)';
          } else if (this.content.color === 'teal') {
            return 'rgb(0, 96, 103)';
          } else {
            return '#000000';
          }
        }
      },
      template: `
        <input
          type="text"
          placeholder="Titolo sezione"
          :value="content.text"
          @input="update({ text: $event.target.value })"
          :style="{ color: color }"
        />
      `
    }
  }
});
