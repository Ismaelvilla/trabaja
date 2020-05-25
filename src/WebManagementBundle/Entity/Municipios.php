<?php

namespace WebManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipios
 *
 * @ORM\Table(name="municipios")
 * @ORM\Entity
 */
class Municipios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_municipio", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMunicipio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_provincia", type="smallint", nullable=false)
     */
    private $idProvincia;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_municipio", type="integer", nullable=false)
     */
    private $codMunicipio;

    /**
     * @var integer
     *
     * @ORM\Column(name="DC", type="integer", nullable=false)
     */
    private $dc;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre = '\'\'';


}

