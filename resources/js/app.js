import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

// CSS
import '../css/reset.css'
import '../css/admin.css'

createInertiaApp({
    resolve: name =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        app.use(plugin)

        // Client-only: Echo + Pusher
        if (typeof window !== 'undefined') {
            import('./bootstrap.client')
        }

        app.mount(el)
    },
})
