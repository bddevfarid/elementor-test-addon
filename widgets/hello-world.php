<?php

namespace Elementor_Test_Addon\Widgets;

class Elementor_Hello_World extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hello-world';
	}

	public function get_title() {
		return esc_html__( 'Hello World', 'elementor-test-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'abc' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}

    //style dependency
    public function get_style_depends() {
        return [ 'hello-world' ];
    }

    //help url for this widget
    public function get_custom_help_url() {
        return 'https://bddevfarid.com/';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'elementor-test-addon' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'elementor-test-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Hello World!', 'elementor-test-addon' ),
            ]
        );

        $this->end_controls_section();

        //title style
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'elementor-test-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        //title color
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'elementor-test-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .test-addon-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        //title typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'elementor-test-addon' ),
                'selector' => '{{WRAPPER}} .test-addon-title',
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $setting = $this->get_settings_for_display();
		?>

		<h1 class="test-addon-title"> <?php echo esc_html($setting['title']); ?> </h1>

		<?php
	}
}