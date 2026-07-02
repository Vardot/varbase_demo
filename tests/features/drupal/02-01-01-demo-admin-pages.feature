@varbase_demo @admin
Feature: Varbase Demo - administration pages
  As a site administrator
  I want to reach the content administration and structure pages

  Background:
    Given I am a logged in user with the "Webmaster" user

  Scenario: The Demo page content type is listed
    When I go to "/admin/structure/types"
    Then I should see "Demo page"

  Scenario: The Demo page create form loads
    When I go to "/node/add/varbase_demo_page"
    Then I should see "Create Demo page"

  Scenario: The content administration overview loads
    When I go to "/admin/content"
    Then I should see "Content"
