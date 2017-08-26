<?php


namespace ElementsFramework\Layout\Contract;

use Illuminate\View\View;

/**
 * Class UIElement
 * @package ElementsFramework\Layout\Contract
 */
abstract class UIElement
{

    /**
     * Namespace of the package the element is published in definition.
     * @var string
     */
    protected $namespace;

    /**
     * User readable name of the UI element that will be shown in the builder.
     * @var string
     */
    protected $name;

    /**
     * HTML element that renders the icon that is shown for the element in the builder.
     * NOTE: Please use Font awesome for any publicly available elements.
     * @var string
     */
    protected $icon;

    /**
     * Sets the template that will be rendered inside of this UI element.
     * This is usually used for wrapper elements (containing other elements in them).
     * For more details visit https://github.com/ElementsFramework/LayoutBuilderUI
     * @var string
     */
    protected $content = null;

    /**
     * This array contains the default content data definition that will be rendered on init.
     * This is usually used for wrapper elements (containing other elements in them).
     * For more details visit https://github.com/ElementsFramework/LayoutBuilderUI
     * @var array
     */
    protected $contentData = null;

    /**
     * Settings definition array that defines the settings form schema.
     * For more details visit https://github.com/ElementsFramework/LayoutBuilderUI
     * @var array
     */
    protected $settingsDefinition = null;

    /**
     * Options that are used to render the element.
     * @var array
     */
    protected $options = [];

    /**
     * Data used inside the render template.
     * @var array
     */
    protected $data = [];

    /*
     * Methods
     */


    /**
     * Allows you to pass data to the view when it gets rendered.
     * @param View $view
     */
    public abstract static function renderViewComposer(View $view);

    /**
     * Returns the view name this element renders.
     * @return string
     */
    public abstract static function getViewName();

    /*
     * Getters & Setters
     */

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function getContentData()
    {
        return $this->contentData;
    }

    /**
     * @return array
     */
    public function getSettingsDefinition()
    {
        return $this->settingsDefinition;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param array $contentData
     */
    public function setContentData($contentData)
    {
        $this->contentData = $contentData;
    }

}