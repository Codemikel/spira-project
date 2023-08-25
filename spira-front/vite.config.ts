import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  resolve: {
    alias: [
      { find: '@assets', replacement: path.resolve( 'src/assets/') },
      { find: '@components', replacement: path.resolve( 'src/components/') },
      { find: '@styles', replacement: path.resolve( 'src/styles/') },
      { find: '@utils', replacement: path.resolve( 'src/utils/') },
      { find: '@hooks', replacement: path.resolve( 'src/hooks/') },
      { find: '@views', replacement: path.resolve( 'src/views/') },
  ],
  },
})
