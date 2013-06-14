<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-08 
 */

namespace Test\Net\Bazzline\Component\TestCase;

use Mockery;

/**
 * Class MockFactory
 *
 * @package Test\Net\Bazzline\Component\TestCase
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-08
 */
class MockFactory
{
    /**
     * Creates single answer mock
     *
     * @return Mockery\MockInterface|\Net\Bazzline\Component\TestCase\Answer\SingleAnswer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-08
     */
    public static function getSingleAnswer()
    {
        $answer = Mockery::mock('Net\Bazzline\Component\TestCase\Answer\SingleAnswer');

        return $answer;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\TestCase\Question\Question
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-08
     */
    public static function getQuestion()
    {
        $question = Mockery::mock('Net\Bazzline\Component\TestCase\Question\Question');

        return $question;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\TestCase\TestCase\TestCase
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-08
     */
    public static function getTestCase()
    {
        $testCase = Mockery::mock('Net\Bazzline\Component\TestCase\TestCase\TestCase');

        return $testCase;
    }

    /**
     * Tears down mock factory
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-08
     */
    public static function tearDown()
    {
        Mockery::close();
    }
}