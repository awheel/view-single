<?php

namespace awheel\ViewSingle;

/**
 * View Single
 *
 * @package awheel
 */
class ViewSingle
{
    /**
     * 配置
     *
     * @var array
     */
    protected $config = [];

    /**
     * 传递给 View 的数据
     *
     * @var array
     */
    protected $viewVars = [];

    /**
     * View 名称
     *
     * @var
     */
    protected $viewName;

    /**
     * 模板是否已经渲染过
     *
     * @var bool
     */
    protected $rendered = false;

    /**
     * View constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * 渲染
     *
     * @param $module
     * @param $viewName
     * @param array $vars
     *
     * @return string
     */
    public function render($module, $viewName, $vars = [])
    {
        if (!isset($this->config[$module])) {
            return 'module not exist';
        }

        $this->viewName = $this->config[$module] . '/' . $viewName;
        $this->viewVars = array_merge($this->viewVars, (array) $vars);

        if (!file_exists($this->viewName)) {
            return 'view not exist';
        }

        extract($this->viewVars);
        ob_start();
        require $this->viewName;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * 给模板赋值
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function assign($key, $value)
    {
        if ($this->rendered === true) {
            return false;
        }

        $this->viewVars = array_merge($this->viewVars, [$key => $value]);

        return true;
    }

    /**
     * 获取当前 View 配置
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * 获取传递给 view 的数据
     *
     * @return array
     */
    public function getVars()
    {
        return $this->viewVars;
    }
}
