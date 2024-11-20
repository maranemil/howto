Create a plugin that reads customer data from the Customer module and uses it to enhance a ProductAbstractTransfer object.

Example: Plugin Reading Data from the Customer Module
1. Create the Plugin
Create a plugin in your module's Communication\Plugin directory.

~~~php
Copy code
namespace Pyz\Zed\Product\Communication\Plugin;

use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractExpanderPluginInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\Product\ProductConfig getConfig()
 * @method \Pyz\Zed\Product\Business\ProductFacadeInterface getFacade()
 */
class ProductCustomerDataExpanderPlugin extends AbstractPlugin implements ProductAbstractExpanderPluginInterface
{
    /**
     * @var \Spryker\Zed\Customer\Business\CustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @param \Spryker\Zed\Customer\Business\CustomerFacadeInterface $customerFacade
     */
    public function __construct($customerFacade)
    {
        $this->customerFacade = $customerFacade;
    }

    /**
     * Expands ProductAbstractTransfer with customer-related data.
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function expand(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        $customerId = $this->getCustomerIdForProduct($productAbstractTransfer->getSku());
        if ($customerId !== null) {
            $customerTransfer = $this->customerFacade->findCustomerById($customerId);

            if ($customerTransfer !== null) {
                $productAbstractTransfer->setCustomerReference($customerTransfer->getCustomerReference());
            }
        }

        return $productAbstractTransfer;
    }

    /**
     * Example: Logic to determine the customer ID related to a product.
     *
     * @param string $productSku
     *
     * @return int|null
     */
    protected function getCustomerIdForProduct(string $productSku): ?int
    {
        // Logic to retrieve customer ID based on the product SKU
        // For simplicity, return a hardcoded value or use a service
        return 123; // Example customer ID
    }
}
~~~


2. Register the Plugin
In the ProductDependencyProvider, register this plugin so it can be used by the Product module.

~~~php
Copy code
namespace Pyz\Zed\Product;

use Spryker\Zed\Product\ProductDependencyProvider as SprykerProductDependencyProvider;
use Pyz\Zed\Product\Communication\Plugin\ProductCustomerDataExpanderPlugin;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;

class ProductDependencyProvider extends SprykerProductDependencyProvider
{
    /**
     * @return \Spryker\Zed\Product\Dependency\Plugin\ProductAbstractExpanderPluginInterface[]
     */
    protected function getProductAbstractExpanderPlugins(): array
    {
        return [
            new ProductCustomerDataExpanderPlugin($this->getCustomerFacade()), // Inject the Customer Facade
        ];
    }

    /**
     * Provide the Customer Facade.
     *
     * @return \Spryker\Zed\Customer\Business\CustomerFacadeInterface
     */
    protected function getCustomerFacade(): CustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerDependencyProvider::FACADE_CUSTOMER);
    }
}
~~~


3. Facade Dependency Setup
Ensure the Customer facade is properly provided in the dependency provider. This is typically already handled in the core Customer module, but you can check your dependency provider if needed.

4. Use the Plugin
Once registered, the plugin will be called wherever the ProductAbstractExpanderPluginInterface is used, for example, during product data preparation in the ProductFacade.

Key Points:
The plugin uses a facade from the Customer module to read customer data.
Facades are the standard way to interact with other modules in Spryker, ensuring a clean and modular architecture.
The logic inside the plugin determines how the external data is fetched and applied.
This approach is common when you need to enrich transfer objects by pulling in data from related modules, like enhancing products with customer or order information.