@varbase_demo @content
Feature: Varbase Demo - demo content
  As a content editor
  I want to render and create demo content

  Scenario: The published demo node renders for an anonymous visitor
    Given I am an anonymous user
    When I am on "/node/1"
    Then I should see "Welcome to Varbase Demo"

  Scenario: An author creates and saves a demo page
    Given I am a logged in user with the "Webmaster" user
    When I create a demo page titled "Spring Product Showcase"
    Then I should see "has been created"

  Scenario: A created demo page appears in the content admin
    Given I am a logged in user with the "Webmaster" user
    When I create a demo page titled "QA Demo Page"
    And I go to "/admin/content"
    Then I should see "QA Demo Page"
