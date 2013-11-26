<?php

/**
 * David Wright Images
 *
 * @author  Elliot Wright <wright.elliot@gmail.com>
 * @since   2013
 * @package DWI
 */

namespace DWI\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gallery Image Entity
 *
 * @ORM\Table(name="Image")
 * @ORM\Entity
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=250, nullable=false)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastModified", type="datetime", nullable=false)
     */
    private $lastmodified;

    /**
     * @var \DWI\PortfolioBundle\Entity\Gallery
     *
     * @ORM\ManyToOne(targetEntity="DWI\PortfolioBundle\Entity\Gallery", inversedBy="images")
     * @ORM\JoinColumn(name="galleryId", referencedColumnName="id")
     */
    private $gallery;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Image
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get lastmodified
     *
     * @return \DateTime
     */
    public function getLastmodified()
    {
        return $this->lastmodified;
    }

    /**
     * Set lastmodified
     *
     * @param \DateTime $lastmodified
     * @return Image
     */
    public function setLastmodified($lastmodified)
    {
        $this->lastmodified = $lastmodified;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gallery
     *
     * @param \DWI\PortfolioBundle\Entity\Gallery $gallery
     * @return Image
     */
    public function setGallery(\DWI\PortfolioBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \DWI\PortfolioBundle\Entity\Gallery
     */
    public function getGalleryId()
    {
        return $this->gallery;
    }

    /**
     * Gets absolute path for image, i.e. exact filesystem location
     *
     * @return string
     */
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir() . '/' . $this->path;
    }

    /**
     * Gets absolute path for thumbnail image, i.e. exact filesystem location
     *
     * @return string
     */
    public function getAbsoluteThumbPath()
    {
        if (null === $this->path) {
            return null;
        }

        $pi = pathinfo($this->path);

        return $this->getUploadRootDir() . '/' . $pi['dirname'] . '/' . $pi['filename'] . '_thumb.' . $pi['extension'];
    }

    /**
     * Gets web path for image, i.e. relative web location
     *
     * @return string
     */
    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir() . '/' . $this->path;
    }

    /**
     * Gets web path for thumbnail image, i.e. relative web location
     *
     * @return string
     */
    public function getWebThumbPath()
    {
        if (null === $this->path) {
            return null;
        }

        $pi = pathinfo($this->path);

        return $this->getUploadDir() . '/' . $pi['dirname'] . '/' . $pi['filename'] . '_thumb.' . $pi['extension'];
    }

    /**
     * Gets upload root directory, i.e. exact filesystem location
     *
     * @return string
     */
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * Gets web path, i.e. relative web location
     *
     * @return string
     */
    protected function getUploadDir()
    {
        return 'bundles/dwiportfolio/albums';
    }
}