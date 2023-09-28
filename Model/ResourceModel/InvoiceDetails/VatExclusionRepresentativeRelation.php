<?php
    /**
     * @Thomas-Athanasiou
     *
     * @author Thomas Athanasiou {thomas@hippiemonkeys.com}
     * @link https://hippiemonkeys.com
     * @link https://github.com/Thomas-Athanasiou
     * @copyright Copyright (c) 2023 Hippiemonkeys Web Intelligence EE All Rights Reserved.
     * @license http://www.gnu.org/licenses/ GNU General Public License, version 3
     * @package Hippiemonkeys_SkroutzMarketplace
     */

    declare(strict_types=1);

    namespace Hippiemonkeys\SkroutzMarketplace\Model\ResourceModel\InvoiceDetails;

    use Magento\Framework\Model\AbstractModel as MagentoAbstractModel,
        Hippiemonkeys\Core\Api\Data\ModelInterface,
        Hippiemonkeys\Core\Model\Spi\ModelRelationProcessorInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface,
        Hippiemonkeys\SkroutzMarketplace\Api\Data\InvoiceDetailsInterface,
        Magento\Framework\Exception\NoSuchEntityException;

    class VatExclusionRepresentativeRelation
    implements ModelRelationProcessorInterface
    {
        /**
         * Constructor
         *
         * @access public
         *
         * @param \Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface $vatExclusionRepresentativeRepository
         */
        public function __construct(
            VatExclusionRepresentativeRepositoryInterface $vatExclusionRepresentativeRepository
        )
        {
            $this->vatExclusionRepresentativeRepository = $vatExclusionRepresentativeRepository;
        }

        /**
         * @inheritdoc
         */
        public function processModelRelation(ModelInterface $model): void
        {
            if($model instanceof InvoiceDetailsInterface)
            {
                $vatExclusionRepresentative = $model->getVatExclusionRepresentative();
                if($vatExclusionRepresentative !== null)
                {
                    $vatExclusionRepresentativeRepository = $this->getVatExclusionRepresentativeRepository();
                    if($vatExclusionRepresentative->getId() === null)
                    {
                        try
                        {
                            $vatExclusionRepresentative->setId(
                                $vatExclusionRepresentativeRepository->getByIdTypeAndIdNumber(
                                    $vatExclusionRepresentative->getIdType(),
                                    $vatExclusionRepresentative->getIdNumber()
                                )
                                ->getId()
                            );
                        }
                        catch(NoSuchEntityException)
                        {
                            if ($vatExclusionRepresentative instanceof MagentoAbstractModel)
                            {
                                $vatExclusionRepresentative->isObjectNew(true);
                            }
                        }
                    }

                    $vatExclusionRepresentativeRepository->save($vatExclusionRepresentative);
                    $model->setVatExclusionRepresentative($vatExclusionRepresentative);
                }
            }
        }

        /**
         * Accept Options Pickup Window Relation Repository property
         *
         * @access private
         *
         * @var \Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface $vatExclusionRepresentativeRepository
         */
        private $vatExclusionRepresentativeRepository;

        /**
         * Gets Accept Options Pickup Window Relation Repository
         *
         * @access protected
         * @final
         *
         * @return \Hippiemonkeys\SkroutzMarketplace\Api\VatExclusionRepresentativeRepositoryInterface
         */
        protected final function getVatExclusionRepresentativeRepository(): VatExclusionRepresentativeRepositoryInterface
        {
            return $this->vatExclusionRepresentativeRepository;
        }
    }
?>