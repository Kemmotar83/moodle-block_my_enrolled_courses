<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    block
 * @subpackage block_my_enrolled_courses
 * @copyright  Dualcube (http://dualcube.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once('functions.php');

class block_my_enrolled_courses extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_my_enrolled_courses');
    }

    public function get_content() {
        global $CFG, $PAGE;

        $PAGE->requires->js('/blocks/my_enrolled_courses/js/jquery-1.10.2.js');
        $PAGE->requires->js('/blocks/my_enrolled_courses/js/jquery-ui.js');
        $PAGE->requires->js('/blocks/my_enrolled_courses/js/sortable.js');
        $PAGE->requires->css('/blocks/my_enrolled_courses/style.css');

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();

        $html = block_my_enrolled_courses_visible_in_block();
        $this->content->text = $html;

        $url = new moodle_url($CFG->wwwroot . '/blocks/my_enrolled_courses/showhide.php', array('contextid' => $this->context->id));
        $link = html_writer::link($url, get_string('showhide', 'block_my_enrolled_courses'));
        $this->content->footer = $link;

        return $this->content;
    }
}
