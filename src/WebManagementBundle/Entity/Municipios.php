<?php

namespace WebManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipios
 *
 * @ORM\Table(name="municipios")
 * @ORM\Entity(repositoryClass="WebManagementBundle\Repository\MunicipiosRepository")
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

    /**
     * Get idMunicipio
     *
     * @return int
     */
    public function getid_municipio()
    {
        return $this->idMunicipio;
    }

    /**
     * Get idProvincia
     *
     * @return int
     */
    public function getid_provincia()
    {
        return $this->idProvincia;
    }

    /**
     * Get dc
     *
     * @return integer
     */
    public function getDc()
    {
        return $this->dc;
    }

    /**
     * Set dc
     *
     * @param integer $dc
     *
     * @return Municipios
     */
    public function setDc($dc)
    {
        $this->dc = $dc;

        return $this;
    }

    /**
     * Set codMunicipio
     *
     * @param string $codMunicipio
     *
     * @return Municipios
     */
    public function setcodMunicipio($codMunicipio)
    {
        $this->codMunicipio = $codMunicipio;

        return $this;
    }

    /**
     * Get codMunicipio
     *
     * @return string
     */
    public function getcodMunicipio()
    {
        return $this->codMunicipio;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Municipios
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

}

