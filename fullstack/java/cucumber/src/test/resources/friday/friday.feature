Feature: Is it Friday yet?
  Everybody wants to know when it's Friday

#  Scenario: Sunday isn't Friday
#    Given today is Sunday
#    When I ask whether it's Friday yet
#    Then I should be told "Nope"
#
#
#  Scenario: Friday is Friday
#    Given today is Friday
#    When I ask whether it's Friday yet
#    Then I should be told "TGIF"

  Scenario Outline: Today is or is not Friday
    Given today is "<day>"
    When I ask whether it's Friday yet
    Then I should be told "<answer>"

    Examples:
      | day            | answer |
      | Friday         | TGIF   |
      | Sunday         | Nope   |
      | anything else! | Nope   |