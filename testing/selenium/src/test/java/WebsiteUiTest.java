import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertFalse;
import static org.junit.jupiter.api.Assertions.assertTrue;

import java.time.Duration;

import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.WebDriverWait;

class WebsiteUiTest {
    private WebDriver browser;
    private String baseUrl;

    @BeforeEach
    void startBrowser() {
        baseUrl = System.getProperty("baseUrl", "http://127.0.0.1:8000");
        browser = new ChromeDriver();
        browser.manage().timeouts().implicitlyWait(Duration.ofSeconds(5));
    }

    @AfterEach
    void stopBrowser() {
        if (browser != null) {
            browser.quit();
        }
    }

    @Test
    void homePageLoads() {
        browser.get(baseUrl + "/");

        assertEquals("TechNova Solutions - Technology Solutions", browser.getTitle());
    }

    @Test
    void contactPageContainsContactForm() {
        browser.get(baseUrl + "/contact");

        assertTrue(browser.findElement(By.cssSelector("form[action$='/contact']")).isDisplayed());
        assertTrue(browser.findElement(By.name("name")).isDisplayed());
        assertTrue(browser.findElement(By.name("email")).isDisplayed());
        assertTrue(browser.findElement(By.name("subject")).isDisplayed());
        assertTrue(browser.findElement(By.name("message")).isDisplayed());
    }

    @Test
    void publicSiteNavigationLoadsEveryPublicSection() {
        String[] publicPaths = {"/", "/about", "/services", "/portfolio", "/technologies", "/blog", "/contact"};

        for (String publicPath : publicPaths) {
            browser.get(baseUrl + publicPath);

            assertFalse(browser.findElements(By.cssSelector("body")).isEmpty(), "Missing page body for " + publicPath);
            assertTrue(browser.findElement(By.cssSelector("body")).getText().length() > 0,
                "Empty page for " + publicPath);
        }
    }

    @Test
    void visitorCanSubmitContactForm() {
        browser.get(baseUrl + "/contact");

        browser.findElement(By.name("name")).sendKeys("Selenium Visitor");
        browser.findElement(By.name("email")).sendKeys("selenium@example.com");
        browser.findElement(By.name("subject")).sendKeys("Automation test enquiry");
        browser.findElement(By.name("message")).sendKeys("This message was submitted by the Selenium test suite.");
        browser.findElement(By.cssSelector("form[action$='/contact']")).submit();

        new WebDriverWait(browser, Duration.ofSeconds(5))
            .until(driver -> driver.getCurrentUrl().contains("/contact"));
        assertTrue(browser.findElement(By.cssSelector(".alert-success")).getText()
            .contains("Your message has been sent successfully"));
    }

    @Test
    void adminGuestIsSentToLogin() {
        browser.get(baseUrl + "/admin/dashboard");

        new WebDriverWait(browser, Duration.ofSeconds(5))
            .until(driver -> driver.getCurrentUrl().contains("/admin/login"));
    }

    @Test
    void adminCanLoginAndOpenEveryManagementSection() {
        loginAsAdmin();

        String[] adminPaths = {
            "/admin/dashboard",
            "/admin/pages",
            "/admin/services",
            "/admin/portfolio",
            "/admin/technologies",
            "/admin/clients",
            "/admin/testimonials",
            "/admin/blog-categories",
            "/admin/blog-posts",
            "/admin/team-members",
            "/admin/contact-messages",
            "/admin/settings"
        };

        for (String adminPath : adminPaths) {
            browser.get(baseUrl + adminPath);

            assertTrue(browser.findElement(By.cssSelector("main")).isDisplayed(),
                "Admin content did not load for " + adminPath);
            assertTrue(browser.findElement(By.cssSelector("header h2")).getText().length() > 0,
                "Admin heading is missing for " + adminPath);
        }
    }

    @Test
    void adminCanSaveWebsiteSettingsAndLogout() {
        loginAsAdmin();
        browser.get(baseUrl + "/admin/settings");

        String companyName = browser.findElement(By.name("company_name")).getAttribute("value");
        browser.findElement(By.name("company_name")).clear();
        browser.findElement(By.name("company_name")).sendKeys(companyName);
        browser.findElement(By.cssSelector("form[action$='/admin/settings']")).submit();

        new WebDriverWait(browser, Duration.ofSeconds(5))
            .until(driver -> driver.getCurrentUrl().contains("/admin/settings"));
        assertTrue(browser.findElement(By.cssSelector("body")).getText().contains("Website Settings"));

        browser.findElement(By.cssSelector("form[action$='/admin/logout'] button[type='submit']")).click();
        new WebDriverWait(browser, Duration.ofSeconds(5))
            .until(driver -> driver.getCurrentUrl().contains("/admin/login"));
    }

    private void loginAsAdmin() {
        browser.get(baseUrl + "/admin/login");
        browser.findElement(By.name("email")).sendKeys("admin@example.com");
        browser.findElement(By.name("password")).sendKeys("password");
        browser.findElement(By.cssSelector("form[action$='/admin/login'] button[type='submit']")).click();

        new WebDriverWait(browser, Duration.ofSeconds(5))
            .until(driver -> driver.getCurrentUrl().contains("/admin/dashboard"));
    }
}