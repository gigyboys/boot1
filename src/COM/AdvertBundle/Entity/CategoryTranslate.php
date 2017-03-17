<?php

namespace COM\AdvertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryTranslate
 *
 * @ORM\Table(name="at_category_translate")
 * @ORM\Entity(repositoryClass="COM\AdvertBundle\Entity\CategoryTranslateRepository")
 */
class CategoryTranslate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

	/**
	 * @ORM\ManyToOne(targetEntity="COM\AdvertBundle\Entity\Category", inversedBy="categoryTranslates")
	 * @ORM\JoinColumn(name="category_id", nullable=false)
	 */
	private $category;

	/**
	* @ORM\ManyToOne(targetEntity="COM\PlatformBundle\Entity\Locale")
	* @ORM\JoinColumn(name="locale_id", nullable=false)
	*/
	private $locale;


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
     * Set name
     *
     * @param string $name
     * @return CategoryTranslate
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CategoryTranslate
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

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
     * Set category
     *
     * @param \COM\AdvertBundle\Entity\Category $category
     * @return CategoryTranslate
     */
    public function setCategory(\COM\AdvertBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \COM\AdvertBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set locale
     *
     * @param \COM\PlatformBundle\Entity\Locale $locale
     * @return CategoryTranslate
     */
    public function setLocale(\COM\PlatformBundle\Entity\Locale $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \COM\PlatformBundle\Entity\Locale 
     */
    public function getLocale()
    {
        return $this->locale;
    }
}