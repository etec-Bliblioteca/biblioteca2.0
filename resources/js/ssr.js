import { createInertiaApp } from '@inertiajs/vue3';
import { createSSRApp, h } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const appName = process.env.VITE_APP_NAME || 'Laravel';

export default (page) =>
  createInertiaApp({
    page,
    render: renderToString,
    resolve: (name) =>
      resolvePageComponent(
        `./pages/${name}.vue`,
        import.meta.glob('./pages/**/*.vue')
      ),
    setup({ App, props, plugin }) {
      return createSSRApp({ render: () => h(App, props) }).use(plugin);
    },
    title: (title) => `${title} - ${appName}`,
  });
