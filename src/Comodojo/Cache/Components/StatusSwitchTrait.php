<?php namespace Comodojo\Cache\Components;

/**
 * Enable/disable cache trait
 * 
 * @package     Comodojo Spare Parts
 * @author      Marco Giovinazzi <marco.giovinazzi@comodojo.org>
 * @license     MIT
 *
 * LICENSE:
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
 
trait StatusSwitchTrait {
 
    /**
     * Determine the current cache status
     *
     * @var bool
     */
    protected $enabled = null;
    
    /**
     * {@inheritdoc}
     */
    public function enable() {

        $this->enabled = true;
        
        return $this;

    }

    /**
     * {@inheritdoc}
     */
    public function disable() {

        $this->enabled = false;
        
        return $this;

    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled() {

        return $this->enabled;

    }
    
}