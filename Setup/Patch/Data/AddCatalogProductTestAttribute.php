<?php
/**
 * @author Atwix Team
 * @copyright Copyright (c) Atwix (https://www.atwix.com/)
 */

declare(strict_types=1);

namespace Atwix\TestAttribute\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Validator\ValidateException;

/**
 * Create test catalog product attribute.
 */
class AddCatalogProductTestAttribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * Test attribute code.
     */
    public const TEST_ATTRIBUTE_CODE = 'test_attribute';

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly EavSetupFactory $eavSetupFactory
    ) {
    }

    /**
     * Create test catalog product attribute.
     *
     * @return $this
     *
     * @throws LocalizedException
     * @throws ValidateException
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute(
            Product::ENTITY,
            self::TEST_ATTRIBUTE_CODE,
            [
                'type' => 'int',
                'label' => 'Test Attribute Label',
                'input' => 'text',
                'group' => 'Attribute Group',
                'source' => '',
                'frontend' => '',
                'backend' => '',
                'sort_order' => '999',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'default' => 0,
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'searchable' => false,
                'filterable' => false,
                'visible_in_advanced_search' => false,
                'is_html_allowed_on_front' => false,
                'filterable_in_search' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'unique' => false,
                'apply_to' => '',
                'used_in_product_listing' => false,
                'used_for_promo_rules' => false,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false
            ]
        );
        $this->moduleDataSetup->endSetup();

        return $this;
    }

    /**
     * Remove test catalog product attribute.
     *
     * @return void
     */
    public function revert()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->removeAttribute(Product::ENTITY, self::TEST_ATTRIBUTE_CODE);
    }

    /**
     * @ingeritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @ingeritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
