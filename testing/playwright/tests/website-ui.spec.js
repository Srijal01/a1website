import { expect, test } from '@playwright/test';

test('home page loads', async ({ page }) => {
  await page.goto('/');

  await expect(page).toHaveTitle('TechNova Solutions - Technology Solutions');
});

test('contact page contains the contact form', async ({ page }) => {
  await page.goto('/contact');

  await expect(page.locator("form[action$='/contact']")).toBeVisible();
  await expect(page.getByRole('textbox', { name: 'Your Name' })).toBeVisible();
  await expect(page.getByRole('textbox', { name: 'Your Email' })).toBeVisible();
  await expect(page.getByRole('textbox', { name: 'Subject' })).toBeVisible();
  await expect(page.getByRole('textbox', { name: 'Message' })).toBeVisible();
});

test('public site navigation loads every section', async ({ page }) => {
  const publicPaths = ['/', '/about', '/services', '/portfolio', '/technologies', '/blog', '/contact'];

  for (const publicPath of publicPaths) {
    await page.goto(publicPath);
    await expect(page.locator('body')).not.toBeEmpty();
  }
});

test('visitor can submit the contact form', async ({ page }) => {
  await page.goto('/contact');

  await page.getByRole('textbox', { name: 'Your Name' }).fill('Playwright Visitor');
  await page.getByRole('textbox', { name: 'Your Email' }).fill('playwright@example.com');
  await page.getByRole('textbox', { name: 'Subject' }).fill('Automation test enquiry');
  await page.getByRole('textbox', { name: 'Message' }).fill('This message was submitted by Playwright.');
  await page.locator("form[action$='/contact']").getByRole('button', { name: 'Send Message' }).click();

  await expect(page.locator('.alert-success')).toContainText('Your message has been sent successfully');
});

test('guest is redirected to the admin login page', async ({ page }) => {
  await page.goto('/admin/dashboard');

  await expect(page).toHaveURL(/\/admin\/login/);
});

test('admin can log in and open every management section', async ({ page }) => {
  await loginAsAdmin(page);

  const adminPaths = [
    '/admin/dashboard',
    '/admin/pages',
    '/admin/services',
    '/admin/portfolio',
    '/admin/technologies',
    '/admin/clients',
    '/admin/testimonials',
    '/admin/blog-categories',
    '/admin/blog-posts',
    '/admin/team-members',
    '/admin/contact-messages',
    '/admin/settings',
  ];

  for (const adminPath of adminPaths) {
    await page.goto(adminPath);
    await expect(page.locator('main')).toBeVisible();
    await expect(page.locator('header h2')).not.toBeEmpty();
  }
});

test('admin can save settings and log out', async ({ page }) => {
  await loginAsAdmin(page);
  await page.goto('/admin/settings');

  const companyName = await page.locator('[name="company_name"]').inputValue();
  await page.locator('[name="company_name"]').fill(companyName);
  await page.locator("form[action$='/admin/settings']").getByRole('button', { name: 'Save Settings' }).click();
  await expect(page.locator('.bg-green-100')).toContainText('Settings updated successfully');

  await page.locator("form[action$='/admin/logout']").getByRole('button', { name: 'Logout' }).click();
  await expect(page).toHaveURL(/\/admin\/login/);
});

async function loginAsAdmin(page) {
  await page.goto('/admin/login');
  await page.getByLabel('Email').fill('admin@example.com');
  await page.getByLabel('Password').fill('password');
  await page.getByRole('button', { name: 'Sign In' }).click();
  await expect(page).toHaveURL(/\/admin\/dashboard/);
}
