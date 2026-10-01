import { defineConfig } from '@playwright/test';

export default defineConfig({
  testDir: './tests',
  webServer: {
    command: 'php -S 127.0.0.1:8010 -t public',
    cwd: '../..',
    url: 'http://127.0.0.1:8010',
    reuseExistingServer: true,
    timeout: 120000,
  },
  use: {
    baseURL: process.env.BASE_URL ?? 'http://127.0.0.1:8010',
    headless: true,
    screenshot: 'only-on-failure',
    trace: 'retain-on-failure',
  },
  reporter: [['list'], ['html', { open: 'never' }]],
});
