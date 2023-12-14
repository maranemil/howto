package finonacci;

import io.cucumber.java.en.*;
import org.junit.jupiter.api.Assertions.*;

import java.util.List;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.*;

public class StepDefinitions {

    private int fibResult;

    @Given("Initialisation")
    public void initialisation() {
        this.fibResult = 0;
    }

    @When("^I ask Javascript to calculate fibonacci up to (\\d+)$")
    public void i_ask_javascript_to_calculate_fibonacci_up_to(int n) {
        assertEquals(0, fibResult);
        fibResult = fibonacciSeries(n);
    }


    @Then("it should give me <series>")
    public void it_should_give_me_series(int series) {
        assertEquals(series, fibResult);
    }
}
