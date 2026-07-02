@varbase_demo @permissions
Feature: Varbase Demo - create access by role
  Scenario: Anonymous users cannot create a demo page
    Given I am an anonymous user
    When I am on "/node/add/varbase_demo_page"
    Then I should see "Access denied"

  Scenario: Authenticated users without permission cannot create a demo page
    Given I am a logged in user with the "Normal user" user
    When I am on "/node/add/varbase_demo_page"
    Then I should see "Access denied"

  Scenario: Demo editors can open the demo page create form
    Given I am a logged in user with the "Demo editor" user
    When I am on "/node/add/varbase_demo_page"
    Then I should see "Create Demo page"
