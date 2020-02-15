<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Cards\Entities\CardType;
use Modules\Generator\Exceptions\CardGeneratorAttributeException;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class RangeGeneratorService
 */
class RangeGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return CardGeneratorModel
     * @throws CardGeneratorAttributeException
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getRange()) {
            return $cardGeneratorModel;
        }

        $cardType = $cardGeneratorModel->getCardType();
        $cardGeneratorModel->setRange($this->getRangeByCardType($cardType));

        return $cardGeneratorModel;
    }

    /**
     * Throws Exception if card_type code will not match.
     *
     * @param int $cardTypeId
     * @return int
     * @throws CardGeneratorAttributeException
     */
    private function getRangeByCardType(int $cardTypeId): int
    {
        /** @var CardType $cardType */
        $cardType = CardType::find($cardTypeId);
        $code = $cardType->getAttribute('code');

        switch ($code) {
            case 'light_melee_infantry':
                $range = 1;
                break;
            case 'heavy_Melee_infantry':
                $range = 1;
                break;
            case 'light_distance_infantry':
                $range = 4;
                break;
            case 'heavy_distance_infantry':
                $range = 7;
                break;
            case 'cavalry':
                $range = 1;
                break;
            default:
                throw new CardGeneratorAttributeException(
                    'Fatal: no code matching of card_types',
                    404
                );
                break;
        }

        return $range;
    }
}
